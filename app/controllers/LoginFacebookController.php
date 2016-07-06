<?php

class LoginFacebookController extends \BaseController {

	private $fb;

	public function __construct(FacebookHelper $fb){
		$this->fb = $fb;
	}

	public function login(){
		return Redirect::to($this->fb->getUrlLogin());
	}

	public function callback(){
		if( !$this->fb->generateSessionFromRedirect() ){
			return Redirect::to('/')->with('message', "Error logging into facebook");
		}

		$user_fb = $this->fb->getGraph();

		if(empty($user_fb)) {
			return Redirect::to('/')->with('message', "User Not Found");
		}

		$user = User::whereUidFb($user_fb->getProperty('id'))->first();
		
		if(empty($user)){
			$user = new User;
			$user->name = $user_fb->getProperty('name');
			$user->uid_fb = $user_fb->getProperty('id');

			$user->save();
		}

		$user->access_token_fb = $this->fb->getToken();
		$user->save();

		$user_pages = $this->fb->getPages($user->access_token_fb);
		// var_dump($user_pages);

		Auth::login($user);

		return Redirect::to('/')->with(array('pages' => $user_pages), 'message', 'Logged In');
		
	}

	public function pageCallback($pageid, $token){
		$page_insight = $this->fb->getInsights($pageid, $token);
		$token_fb = $token;
		return Redirect::to('/page')->with(array('page_insight' => $page_insight))->with(array('token_fb' => $token_fb));
	}

	public function pageBack($token){
		$user_pages = $this->fb->getPages($token);
		return Redirect::to('/')->with(array('pages' => $user_pages));
	}
}

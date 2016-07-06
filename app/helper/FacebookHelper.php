<?php

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;
use Facebook\FacebookRequest;


class FacebookHelper
{	
	private $helper;
	private $session;

	public function __construct() {
		FacebookSession::setDefaultApplication(Config::get('facebook.app_id'), Config::get('facebook.app_secret'));

		$this->helper = new FacebookRedirectLoginHelper(url('login/fb/callback'));
	}
	public function getUrlLogin(){
		return $this->helper->getLoginUrl(Config::get('facebook.app_scope'));

	}
	public function generateSessionFromRedirect(){
		$this->session = null;
		try{
			$this->session = $this->helper->getSessionFromRedirect();
		}
		catch(FacebookRequestException $ex){

		}catch(\Exception $ex){

		}
		// var_dump($this->session);
		return $this->session;
	}

	public function generateSessionFromToken($token) {
		$this->session = new FacebookSession($token);
		return $this->session;
	}

	public function getToken() {
		return $this->session->getToken();
	}

	public function getGraph(){
		$request = new FacebookRequest($this->session, 'GET', '/me');
		$response = $request->execute();
		return $response->getGraphObject();
	}

	public function getPages($token){
		$this->session = new FacebookSession($token);
		$request = new FacebookRequest($this->session, 'GET', '/me/accounts?type=page');
		$response = $request->execute();
		return $response->getGraphObject()->getProperty('data')->asArray();
	}

	public function getInsights($pageid, $token){
		$this->session = new FacebookSession($token);
		$request = new FacebookRequest($this->session, 'GET', "/{$pageid}/insights");
		$response = $request->execute();
		return $response->getGraphObject()->getProperty('data')->asArray();
	}
}


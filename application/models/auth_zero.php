<?php
use Auth0\SDK\Auth0;
class Auth_zero extends CI_Model{
    var $domain,$client_id,$client_secret,$redirect_uri,$audience,$auth0;
    function __construct(){
        parent::__construct();
        require 'vendor/autoload.php';
        require 'dotenv-loader.php';
        $this->domain        = getenv('AUTH0_DOMAIN');
        $this->client_id     = getenv('AUTH0_CLIENT_ID');
        $this->client_secret = getenv('AUTH0_CLIENT_SECRET');
        $this->redirect_uri  = getenv('AUTH0_CALLBACK_URL');
        $this->audience      = getenv('AUTH0_AUDIENCE');
        if($this->audience == ''){
          $this->audience = 'https://' . $this->domain . '/userinfo';
        }
        $this->auth0 = new Auth0([
          'domain' => $this->domain,
          'client_id' => $this->client_id,
          'client_secret' => $this->client_secret,
          'redirect_uri' => $this->redirect_uri,
          'audience' => $this->audience,
          'scope' => 'openid profile',
          'persist_id_token' => true,
          'persist_access_token' => true,
          'persist_refresh_token' => true,
        ]);
      }
    function getuser(){
      return $this->auth0->getUser();
    }
}
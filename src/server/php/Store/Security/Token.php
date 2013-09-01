<?php namespace Store\Security;

/**
* CSRF Token
*
* @class Token
* @constructor
*/
class Token {

  /**
  * User's name
  * @property $username
  * @private
  * @type {String}
  * @default ''
  */  
  private $username = '';

  /**
  * User's password
  * @property $password
  * @private
  * @type {String}
  * @default ''
  */  
  private $password = '';

  /**
  * Constructor
  *
  * @method User
  */
  public function __construct($username, $password){
    $this->setUsername($username);
    $this->setPassword($password);
  }

  /**
  * Retrieve user's name
  *
  * @method getUsername
  * @return String username
  */
  public function getUsername(){
    return $this->username;
  }

  /**
  * Set user's name
  *
  * @method setUsername
  */
  protected function setUsername($username){
    $this->username = $username;
  }  

  /**
  * Retrieve user's password
  *
  * @method getPassword
  * @return String password
  */
  public function getPassword(){
    return $this->password;
  }

  /**
  * Set user's password
  *
  * @method setPassword
  */
  protected function setPassword($password){
    $this->password = sha1($password);
  }
}
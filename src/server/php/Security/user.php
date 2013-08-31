<?php namespace Store\Security;

/**
* User Representation
*
* @class User
* @constructor
*/
class User {

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
  public User($username, $password){
    $this->username = $username;
    $this->password = $password;
  }

  /**
  * Retrieve user's name
  *
  * @method Init
  * @return String username
  */
  public function getUsername(){
    return $this->username;
  }
}
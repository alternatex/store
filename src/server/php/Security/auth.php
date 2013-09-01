<?php namespace Store\Security;

// load dependencies
require_once(__DIR__.DIRECTORY_SEPARATOR.'user.php');

/**
* Authentication Service
*
* @class Auth
* @constructor
*/
class Auth {

  /**
  * Singleton
  * @property $instance
  * @private
  * @static
  * @type {Auth}
  * @default null
  */  
  private static $instance = null;

  /**
  * Superuser's name
  * @property $superuser
  * @private
  * @static
  * @type {String}
  * @default 'admin'
  */  
  private static $superuser = 'admin';

  /**
  * Superuser's pass
  * @property $superpass
  * @private
  * @static
  * @type {String}
  * @default ''
  */  
  private static $superpass = 'd033e22ae348aeb5660fc2140aec35850c4da997';

  /**
  * Filepath disk «database»
  * @property $superuser
  * @private
  * @type {String}
  * @default ''
  */  
  private $database = '';

  /**
  * Access control list
  * @property $acl
  * @private
  * @type {array}
  * @default array()
  */    
  private $acl = array();

  /**
  * Constructor
  *
  * @method Auth
  * @param {String} $database  
  */  
  private function Auth($database){
    $this->database = $database;
  }

  /**
  * Retrieve instance 
  *
  * @method getInstance
  * @param {String} $database  
  */  
  public static function GetInstance($database){
    if(self::$instance==null) self::$instance = new Auth($database);
    return self::$instance;
  }

  /**
  * Initialize Access Control
  *
  * @method Init
  * @param {String} $database  
  */  
  public static function Init($database){    
    if(file_exists(self::$instance->database)){
      self::$instance->acl = json_decode(file_get_contents(self::$instance->database));
    }
  } 

  /**
  * User modification handler
  *
  * @method Modify
  * @param {User} $user
  */
  public static function Modify(User $user){
    if($_SESSION['username']==self::$superuser || $_SESSION['username']!=$user->getUsername()){
      die('Requested user does not match current or no administrative privileges given.');
    }
  }

  /**
  * Validate resource access
  *
  * @method Validate
  * @param {User} $user  
  */
  public static function Validate(User $user){

  }

}
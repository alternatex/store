<?php namespace Store\Security;

/**
* Authentication Service
*
* @class Auth
* @constructor
*/
class Auth {

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
  * @method __construct
  * @param {String} $database  
  */  
  private function __construct($database){
    $this->database = $database;
  }

  /**
  * Retrieve instance 
  *
  * @method getInstance
  * @param {String} $database
  * @return {Auth} Auth instance *  
  */  
  public static function GetInstance($database){
    static $instance = null;
    if($instance==null) $instance = new Auth();
    return $instance;
  }

  /**
  * Initialize Access Control
  *
  * @method Init
  * @param {String} $database  
  */  
  public function Init($database){    
    if(file_exists($this->database)){
      $this->acl = json_decode(file_get_contents($this->database));
    }
  } 

  /**
  * User modification handler
  *
  * @method Modify
  * @param {User} $user
  */
  public function Modify(User $user){
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
  public function Validate(User $user){

  }

}
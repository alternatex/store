<?php namespace Store\Repository;

// TODO: 
// - implement store inherited functions & add test scripts
// - add support for additional commands: init, clone

use Store\Repository;

/**
* Git Store 
*
* Basic git integration
*
* @class Git
* @module Server
*/
class Git extends Repository {

  /**
  * Remote collection
  * @property remotes
  * @private
  * @type {Array}
  * @default array()
  */
  protected $remotes = array();

  /**
  * Branch collection
  * @property branches
  * @private
  * @type {Array}
  * @default array()
  */
  protected $branches = array();

  /**
  * Constructor
  *
  * @constructor
  * @method __construct
  * @param {String} $remote  
  * @param {String} $branch  
  */
  public function __construct($remote='origin', $branch='master'){
    $this->remote($remote);
    $this->branch($branch);
  }

  /**
  * Helper to add/remove remote
  *
  * @method remote
  * @param {String} $remote  
  * @param {Boolean} $unset  
  */
  protected function remote($remote, $unset=false){
    if($unset===true){
      unset($this->remotes[$remote]);
    } else {
      $this->remotes[$remote] = array();      
    }
  }

  /**
  * Helper to add/remove branch
  *
  * @method branch
  * @param {String} $branch  
  * @param {Boolean} $unset  
  */
  protected function branch($branch, $unset=false){
    if($unset===true){
      unset($this->branches[$branch]);
    } else {
      $this->branches[$branch] = array();      
    }
  }

  /**
  * Helper to determine default remote/branch 
  *
  * @method defaults
  * @param {String} &$remote  
  * @param {String} &$branch    
  */
  protected function defaults(&$remote, &$branch) {
    if($remote==='') $remote = $this->remote;
    if($branch==='') $branch = $this->branch;
  }

  /**
  * Update file (commit & push) 
  *
  * @method update
  * @param {String} $filename 
  * @void
  */  
  public function update($filename){
    $this->add($filename);
    die($filename);
  }

  /**
  * Retrieve file (pull) 
  *
  * @method get
  * @param {String} $filename 
  * @void
  */  
  public function get($filename=''){
    die($filename);
  }
  
  /**
  * Load repository 
  *
  * @method load
  * @param {String} $remote 
  * @param {String} $branch 
  * @void
  */  
  public function load($origin='', $branch=''){
    $this->defaults($remote, $branch);
    $this->pull($remote, $branch);        
  }

  /**
  * Persist changes (commit & push)
  *
  * @method persist
  * @param {String} $remote 
  * @param {String} $branch 
  * @void
  */  
  public function persist($remote='', $branch=''){
    $this->defaults($remote, $branch);
    $this->commit();
    $this->push($remote, $branch);
  }
  
  /**
  * Add file to repository (add & commit) 
  *
  * @method add
  * @param {String} $filename 
  * @void
  */    
  protected function add($filename){
    exec('git add '.$filename);
    $this->commit('added '.$filename);              
  }
  
  /**
  * Remove file from repository (rm & commit) 
  *
  * @method remove
  * @param {String} $filename 
  * @void
  */       
  public function remove($filename){
    exec('git rm -rf '.$filename);
    $this->commit('removed '.$filename);        
  }

  /**
  * Commit file changes (commit -m $message -a)
  *
  * @method commit
  * @param {String} $message 
  * @void
  */       
  protected function commit($message='commit message'){
    exec('git commit -m "'.$message.'" -a ');
  }

  /**
  * Checkout branch
  *
  * @method checkout
  * @param {String} $branch 
  * @void
  */  
  protected function checkout($branch){
    exec('git checkout -b '.$branch);
  }

  /**
  * Push changes to remote
  *
  * @method push
  * @param {String} $remote 
  * @param {String} $branch 
  * @void
  */  
  protected function push($remote='', $branch=''){
    $this->defaults($remote, $branch);
    exec('git push '.$remote.' '.$branch);
  }

  /**
  * Pull changes from remote
  *
  * @method push
  * @param {String} $remote 
  * @param {String} $branch 
  * @void
  */    
  protected function pull($remote='', $branch=''){
    $this->defaults($remote, $branch);
    exec('git pull '.$remote.' '.$branch);
  }

}
<?php namespace Store\Driver;

use Store\Store;

class BitTorrent extends Store {

  // 3rd party torrent encoding helper
  private $encoder = null; 

  public function __construct(){
    $this->encoder = new \PHP\BitTorrent\Encoder();
  }

  public function update($tracker){

  }

  public function get($tracker=null){

  }
  
  public function remove($tracker){

  }

}
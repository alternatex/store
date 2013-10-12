<?php

use Store\Resource;
use Store\Resource\Item;
use Store\Repository\Memory;

/**
* MemoryTest
*
* @class MemoryTest
* @module Server/Test
*/
class MemoryTest extends PHPUnit_Framework_TestCase {

  private $store;

  public function setUp(){
    $this->store = new Memory();
  }

  public function tearDown(){
    $this->store = null;
  }

  public function create(){

    // create new item
    $item = new Item(array(
      'id'        => 'Id',
      'firstname' => 'FirstName',
      'lastname'  => 'LastName'
    ));   
    
    // store item in memory collection 
    $this->store->update($item);

    // ... silly.
    $data = $item->data();
  }

  public function testCreate($test=true){

    // ...
    $this->create();
  }

  public function testUpdate(){
    
    // create item first *
    $this->create();

    // create new item
    $item = new Item(array('id' => 'Id'));    

    // read item from memory collection 
    $item = $this->store->get($item);

    // ... silly.
    $data = $item;

    // test create
    $this->assertEquals('FirstName', $data['firstname']);
    
    // update
    $data['firstname']='FirstName2';

    // re-create item
    $item = new Item($data);  

    // update item
    $this->store->update($item);

    // read item from memory collection 
    $item = $this->store->get($item);

    // ... silly.
    $data = $item;

    // test
    $this->assertEquals('FirstName2', $data['firstname']);
  }

  public function testRead(){

    // create item first *
    $this->create();

    // create new item
    $item = new Item(array('id' => 'Id'));    

    // read item from memory collection 
    $data = $this->store->get($item);

    // test
    $this->assertEquals('FirstName', $data['firstname']);
  }

  public function testDelete(){

    // create item first *
    $this->create();

    // create new item
    $item = new Item(array('id' => 'Id'));    

    // remove item from collection
    $this->store->remove($item);

    // try reading item from memory collection  
    $item = $this->store->get($item);

    // test
    $this->assertFalse($item);
  }
}
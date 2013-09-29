<?php namespace Store;

/**
* PHP Components *
*
* @module PHP
**/

/**
* Store fundamentals
*
* @class Server
* @constructor
*/
abstract class Store { 

  /**
  * Flag to indicated pending changes
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  private $pending = false;

  /**
  * Items collection
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  protected $items = array();

  /**
  * Datastore filename
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  protected $datastore = null;

  /**
  * HTTP Header storage type indicator
  * @property REQUEST_STORAGE_TYPE_HEADER_FIELD
  * @public
  * @type {String}
  * @default x-storage-type
  * @readOnly
  */
  const REQUEST_STORAGE_TYPE_HEADER_FIELD = 'x-storage-type';

  /**
  * Toggle JSONP
  * @property RESPONSE_JSONP_ENABLED
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const RESPONSE_JSONP_ENABLED = true;

  /**
  * JSON callback identifier
  * @property RESPONSE_JSONP_CALLBACK
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const RESPONSE_JSONP_CALLBACK = 'callback';

  /**
  * Entity attribute count
  * @property ENTITY_COUNT
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const ENTITY_COUNT = 'count';

  /**
  * Entity attribute id
  * @property ENTITY_IDENTIFIER
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const ENTITY_IDENTIFIER = 'id';

  /**
  * l18n datastore.corrupt
  * @property MESSAGE_ERROR_DATASTORE_CORRUPT
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const MESSAGE_ERROR_DATASTORE_CORRUPT = 'DATASTORE SEEMS CORRUPT';

  /**
  * l18n datastore.locked
  * @property MESSAGE_ERROR_DATASTORE_LOCKED
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const MESSAGE_ERROR_DATASTORE_LOCKED = 'DATASTORE IS LOCKED';

  /**
  * Request param action
  * @property REQUEST_ACTION
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const REQUEST_ACTION = 'action';

  /**
  * Request param namespace
  * @property REQUEST_NAMESPACE
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const REQUEST_NAMESPACE = 'namespace';

  /**
  * Request param instance
  * @property REQUEST_DATA
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const REQUEST_DATA = 'instance';

  /**
  * Request param jsonp
  * @property REQUEST_JSONP
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const REQUEST_JSONP = 'jsonp';

  /**
  * Error *
  * @property RESPONSE_ERROR
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const RESPONSE_ERROR = 'error';

  /**
  * Action `get`
  * @property STORE_ACTION_GET
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const STORE_ACTION_GET = 'get';

  /**
  * Action `list`
  * @property STORE_ACTION_LIST
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const STORE_ACTION_LIST = 'list';

  /**
  * Action `remove`
  * @property STORE_ACTION_REMOVE
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const STORE_ACTION_REMOVE = 'remove';

  /**
  * Action `update`
  * @property STORE_ACTION_UPDATE
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const STORE_ACTION_UPDATE = 'update';

  /**
  * Request fileupload param source
  * @property TRANSFER_SOURCE
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const TRANSFER_SOURCE = 'tmp_name';

  /**
  * Request fileupload param name
  * @property TRANSFER_TARGET
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */  
  const TRANSFER_TARGET = 'name';  

  abstract function update($instance);
  abstract function get($instance=null);
  abstract function remove($instance);
  abstract function response($dostore, $response, $jsonp);
  
  /**
  * Get/Set pending changes flag
  * 
  * @method isPending
  * @param {boolean} $pending
  * @return {boolean} 
  */ 
  public function pending($pending=null){
    if($pending!=null) $this->pending = $pending;
    return $this->pending;
  }   
}
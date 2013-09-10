/**
* A lightweight datastore wrapper - Dropbox Edition
* @module Client
**/

// module definition 
(function (root) { var amdExports; define('Dropbox', ['Store', 'underscore'], function (_) { (function (store, underscore) {

/**
* Repository: DropboxRepository
* 
* @method Remote
* @private
* @type {Object}
* @default {Object} instance
*/
var DropboxRepository = function DropboxRepository(){};

/**
* Repository: DropboxRepository.constructor
* 
* @method Remote.constructor
* @private
* @type {Object}
* @default {Object} instance
*/ 
DropboxRepository.prototype = new Repository();

/**
* Dropbox storage
* 
* @method DropboxStore
* @private
* @type {Object}
* @default {Object} instance
*/
var DropboxStore = function DropboxStore(){};

/**
* configuration object.constructor 
* 
* @method DropboxStore.constructor
* @private
* @type {Object}
* @default {Object} instance
*/
DropboxStore.prototype = new Store();

/**
* create instance / new item (bound to datastore)
*
* @method create
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.create = function create(data){

  // TODO ensure data handled properly * !!! // ADD warning if id in data => overwritten (?)
  var instance = new this.Item(data);
  
  if(typeof(data['id'])=='undefined'){
    instance.set('id', Store.guid());
  }
  this.items.push(instance);
  return instance;
};

/**
* Insert/update item
*
* @method update
* @return {Boolean} Returns true on success
*/      
DropboxStore.prototype.update = function update(item, callback){
  
  // TODO: check against schema if set *
  return this.repository.process("update", this.options, Store.wrap(this, item), callback);
};

/**
* Remove item
*
* @method remove
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.remove = function remove(item, callback){
  return this.repository.process("remove", this.options, Store.wrap(this, item), callback);
};

/**
* Retrieve item
*
* @method get
* @param {Object} | {String} item object reference or string uuid 
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.get = function get(item, callback){
  return this.repository.process("get", this.options, Store.wrap(this, item), callback);
};

/**
* Retrieves all items
*
* @method list
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.list = function list(callback, each){
  return this.repository.process("list", this.options, undefined, callback, each);
};

/**
* Filter list - TODO: implement
*
* @method filter
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.filter = function filter(callback, each, filters){
  return this.repository.process("list", this.options, undefined, callback, each);
};

/**
* Instance configuration
*
* @method configure
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.configure = function configure(options){
  if(typeof(options)!="undefined"){
    this.options = DropboxStore.extend(options, this.options);    
  } 
  return this.options;
};

/**
* Item accessor *
*
* @method item
* @return {Boolean} Returns true on success
*/
DropboxStore.prototype.item = function item(index){      
  return this.items[index];
};

// expose
amdExports = root.DropboxStore = DropboxStore;  

// call w/scope
}.call(root));
  
// export *
return amdExports;

}); }(this));
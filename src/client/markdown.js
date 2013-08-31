/**
* A lightweight datastore wrapper - Markdown Edition
* @module Client
**/

// module definition 
(function (root) { var amdExports; define('Markdown', ['Store', 'Markdown.Converter', 'underscore'], function (_) { (function () {

/**
* Repository: MarkdownRepository
* 
* @method Remote
* @private
* @type {Object}
* @default {Object} instance
*/
var MarkdownRepository = function MarkdownRepository(){};

/**
* Repository: MarkdownRepository.constructor
* 
* @method Remote.constructor
* @private
* @type {Object}
* @default {Object} instance
*/ 
MarkdownRepository.prototype = new Repository();

/**
* markdown storage
* 
* @method MarkdownStore
* @private
* @type {Object}
* @default {Object} instance
*/
var MarkdownStore = function MarkdownStore(){};

/**
* configuration object.constructor 
* 
* @method MarkdownStore.constructor
* @private
* @type {Object}
* @default {Object} instance
*/
MarkdownStore.prototype = new Store();

/**
* Transform markdown to HTML
*
* @method toHTML
* @void
*/ 
MarkdownStore.prototype.toHTML = function toHTML(markdown){
	return (new Markdown.Converter()).makeHTML(markdown);
};

/**
* create instance / new item (bound to datastore)
*
* @method create
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.create = function create(data){

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
MarkdownStore.prototype.update = function update(item, callback){
  
  // TODO: check against schema if set *
  return this.repository.process("update", this.options, Store.wrap(this, item), callback);
};

/**
* Remove item
*
* @method remove
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.remove = function remove(item, callback){
  return this.repository.process("remove", this.options, Store.wrap(this, item), callback);
};

/**
* Retrieve item
*
* @method get
* @param {Object} | {String} item object reference or string uuid 
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.get = function get(item, callback){
  return this.repository.process("get", this.options, Store.wrap(this, item), callback);
};

/**
* Retrieves all items
*
* @method list
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.list = function list(callback, each){
  return this.repository.process("list", this.options, undefined, callback, each);
};

/**
* Filter list - TODO: implement
*
* @method filter
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.filter = function filter(callback, each, filters){
  return this.repository.process("list", this.options, undefined, callback, each);
};

/**
* Instance configuration
*
* @method configure
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.configure = function configure(options){
  if(typeof(options)!="undefined"){
    this.options = MarkdownStore.extend(options, this.options);    
  } 
  return this.options;
};

/**
* Item accessor *
*
* @method item
* @return {Boolean} Returns true on success
*/
MarkdownStore.prototype.item = function item(index){      
  return this.items[index];
};

// expose
amdExports = root.MarkdownStore = MarkdownStore;  

// call w/scope
}.call(root));
  
// export *
return amdExports;

}); }(this));
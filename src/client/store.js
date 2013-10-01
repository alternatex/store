/**
* A lightweight datastore wrapper
* @module Client
**/

// TODO: 
// - add enhanced "class" support w/ getter/setter if avail: Object.defineProperty(fnc.prototype, ...)
// - process custom X-Store-* response headers

// module definition 
(function (root) { var amdExports; define('store', ["underscore"], function (_) { (function () {

/**
* configuration object
* 
* @method Options
* @private
* @type {Object}
* @default {Object} instance
*/
var Options = function Options(){};

/**
* configuration object.constructor 
* 
* @method Options.constructor
* @private
* @type {Object}
* @default {Object} instance
*/
Options.prototype = {

  /**
  * Remote storage location
  * 
  * @property options.url
  * @type {Object}
  * @default "foo"
  */      
  url: "http://localhost/datastore.php",

  /**
  * Storage namespace  
  * 
  * @property options.namespace
  * @type {Object}
  * @default "foo"
  */      
  namespace: "documents",

  /**
  * JSONP callback fnc name
  * 
  * @property options.jsonp
  * @type {Object}
  * @default "foo"
  */      
  jsonp: "callback",

  /**
  * Cache enabled
  * 
  * @property options.cache
  * @type {Object}
  * @default "foo"
  */      
  cache: true,

  /**
  * Cache Lifetime
  * 
  * @property options.ttl
  * @type {Object}
  * @default "foo"
  */      
  ttl: 3600
};

/**
* Repository - Storage Base Class
* 
* @method Repository
* @private
* @type {Object}
* @default {Object} instance
*/
var Repository = function Repository(){};

/**
* Repository constructor
* 
* @method Repository.constructor
* @private
* @type {Object}
* @default {Object} instance
*/
Repository.prototype = {};

/**
* Repository: Remote
* 
* @method Remote
* @private
* @type {Object}
* @default {Object} instance
*/
var Remote = function Remote(){};

/**
* Repository: Remote.constructor
* 
* @method Remote.constructor
* @private
* @type {Object}
* @default {Object} instance
*/ 
Remote.prototype = new Repository();

/**
* Process action on remote 
*
* @method process
* @param {String} action [list, get, update, remove]
* @param {Object} options configuration
* @param {Object} item arbitrary object *
* @param {Function} callback handle 
* @param {Boolean} each apply callback fnc for each object? (default: false)
* @return {Boolean} Returns true on success
*/
Remote.prototype.process = function process(action, options, item, oncallback, each){    

  // prepare
  var each = each || false, 
      serialized = (typeof(item)!="undefined" && typeof(item.data)!="undefined") ? Store.serialize(item.data) : "instance=false",
      callback = "callback_"+Store.guid('_'),
      options = options,
      script = document.createElement("script");

  // mark callback *
  script.id = callback;

  var decallback = _.Deferred();

  // TODO: ajax form upload => post *

  // attach custom callback handler
  root[callback]=function(data){
    
    // custom callback?
    if(typeof(oncallback)!="undefined"){

      // callback per item or block?
      if(each!==false) {
        
        // process item
        data.forEach(function(item){ oncallback(item); });

      } else {
        // process block
        oncallback(data);
      }     
    }
    
    // cleanup function
    root[callback]=undefined;
    delete root[callback];

    // cleanup script
    script = document.querySelector('#'+callback);
    script.parentNode.removeChild(script);

    // promise fulfilled *
    decallback.resolve(data);
  };

  // setup
  script.src = options.url+"?namespace="+options.namespace+"&action="+action+"&jsonp="+callback /*options.jsonp*/+"&bust="+(new Date().getTime())+"&"+serialized;
  
  // load
  setTimeout(function(){
    document.body.appendChild(script);  
  }, 1);
  
  // ttl exceeded - fail *
  // TODO: server late reply handle? » just because we're ignorants doesn't mean nothing happens.
  setTimeout(function(){
    decallback.reject('request timed out (' + options.ttl + ')');
  },options.ttl);      

  // return deferred *
  return decallback.promise();
};    

/**
* Store consumer
* @class Store
* @constructor
*/
function Store(options){
  
  /**
  * Self-Reference 
  * 
  * @property self
  * @private
  * @type {Object}
  * @default "foo"
  */      
  var self = this; 

  /**
  * Store configuration
  * 
  * @property options
  * @type {Object}
  * @default {}
  */
  this.options = new Options();     

  /**
  * configuration options
  * 
  * @property options
  * @public
  * @type {Object}
  * @default {}
  */
  this.configure(options);
  
  /**
  * Repository
  * 
  * @property repository
  * @private
  * @type {Repository}
  * @default new Remote()
  */      
  this.repository = new Remote();     
  
  /**
  * Repository Item
  * 
  * @property Item
  * @private
  * @type {Function}
  * @default Function
  */
  this.Item = function Item(data){
    this.data = { instance: {} };
    for(var property in data){
      this.data.instance[property]=data[property];
    }    
  };

  /**
  * Item.constructor
  * 
  * @property Item.constructor
  * @private
  * @type {Object}
  * @default Object
  */    
  this.Item.prototype = {
    
    /**
    * Store-Reference
    * 
    * @property datastore
    * @private
    * @type {Object}
    * @default Self-Reference
    */    
    datastore: this,

    /**
    * Object's Datastore
    * 
    * @property data
    * @private
    * @type {Object}
    * @default { instance: {} }
    */ 
    contents: { instance: {} },

    /**
    * Set item property
    *
    * @method set
    * @param {String} property key
    * @param {String} property value
    * @return {Boolean} Returns true on success
    */   
    set: function set(property, value){         
      if(value===false) {
        delete this.data.instance[property];
      } else {
        this.data.instance[property] = value; 
      }
    },

    /**
    * Get item property
    *
    * @method get
    * @param {String} property key      
    * @return {Boolean} Returns true on success
    */   
    get: function get(property){ 
      return this.data.instance[property]; 
    },

    /**
    * Persist item 
    *
    * @method update
    * @param {Function} callback *      
    * @return {Boolean} Returns true on success
    */         
    update: function update(callback){
      return this.datastore.update(this, callback);
    },

    /**
    * Remove item
    *
    * @method remove
    * @param {Function} callback *            
    * @return {Boolean} Returns true on success
    */         
    remove: function remove(callback){
      return this.datastore.remove(this, callback);
    },  

    // TODO: general getter/setter for data => adjust attribute naming ***!!!

    /**
    * Retrieves all items
    *
    * @method all
    * @return {Boolean} Returns true on success
    */             
    all: function all(data){
      if(typeof(data)!="undefined"){
        this.data.instance = data;  
      }
      return this.data.instance;
    }
  };

  /**
  * Interface *
  * 
  * @property api
  * @private
  * @type {Object}
  * @default "foo"
  */
  var api = {};

  // map api 
  ['get', 'list', 'update', 'remove', 'configure', 'create', 'filter'].

    // expose *
    forEach(function(fnc){             

      // for now: direct delegation from api to instance *
      api[fnc] = function(){ return self[fnc].apply(self, Array.prototype.slice.apply(arguments, [])); };
    }
  );

  // expose *
  return api;
}

/**
* Store prototype definition
*
* @property prototype
* @type {Object}
* @default {}
*/
Store.prototype = {
  
  /**
  * LRU cache * - TODO: implement
  * 
  * @property cache
  * @type {Object}
  * @default {}
  */
  cache: {}, 

  /**
  * Items collection
  * 
  * @property items
  * @type {Array}
  * @default []
  */
  items: [],

  /**
  * JSON Schema *
  * 
  * @property schema
  * @type {Object}
  * @default null
  */
  schema: null,

  /**
  * Insert/update item
  *
  * @method update
  * @return {Boolean} Returns true on success
  */      
  update: function update(item, callback){
    
    // TODO: check against schema if set *
    return this.repository.process("update", this.options, Store.wrap(this, item), callback);
  },

  /**
  * Remove item
  *
  * @method remove
  * @return {Boolean} Returns true on success
  */
  remove: function remove(item, callback){
    return this.repository.process("remove", this.options, Store.wrap(this, item), callback);
  },
  
  /**
  * Retrieve item
  *
  * @method get
  * @param {Object} | {String} item object reference or string uuid 
  * @return {Boolean} Returns true on success
  */
  get: function get(item, callback){
    return this.repository.process("get", this.options, Store.wrap(this, item), callback);
  },

  /**
  * Retrieves all items
  *
  * @method list
  * @return {Boolean} Returns true on success
  */
  list: function list(callback, each){
    return this.repository.process("list", this.options, undefined, callback, each);
  },

  /**
  * Filter list - TODO: implement
  *
  * @method filter
  * @return {Boolean} Returns true on success
  */
  filter: function filter(callback, each, filters){
    return this.repository.process("list", this.options, undefined, callback, each);
  },

  /**
  * Instance configuration
  *
  * @method configure
  * @return {Boolean} Returns true on success
  */
  configure: function configure(options){
    if(typeof(options)!="undefined"){
      this.options = Store.extend(options, this.options);    
    } 
    return this.options;
  },

  /**
  * Item accessor *
  *
  * @method item
  * @return {Boolean} Returns true on success
  */
  item: function item(index){      
    return this.items[index];
  },

  /**
  * create instance / new item (bound to datastore)
  *
  * @method create
  * @return {Boolean} Returns true on success
  */
  create: function create(data){

    // bc?
    if(typeof(data)=='undefined'){
      console.warn('Store.create: data is undefined, empty object assigned');
      data = {};
    }

    // TODO ensure data handled properly * !!! // ADD warning if id in data => overwritten (?)
    var instance = new this.Item(data);
    
    if(typeof(data['id'])=='undefined'){
      instance.set('id', Store.guid());
    }
    this.items.push(instance);
    return instance;
  },

  /**
  * JSON schema getter/setter
  *
  * @method schema  
  * @return {Object} object
  */
  schema: function schema(schema){
    if(typeof(schema)!="undefined"){
      this.options.schema = schema;
    }
    return this.options.schema;
  }
};

/**
* Apply general options - default / fallback
*
* @method __configure
* @param {Object} options A configure object
* @return {Boolean} Returns true on success
*/ 
Store.configure = function configure(options){
  Options.prototype = Store.extend(options, Options.prototype);
  return Options.prototype;
};

/**
* one-dimensional object merge *
*
* @method extend
* @return {Boolean} Returns true on success
*/
Store.extend = function extend(source, target){
  for(var property in source) {
    target[property] = source[property];
  }
  return target;
};

/**
* Passthrough if item is object. If type is string » wrapped into Item instance with id set to `item`
*
* @method wrap
* @param {Object} {String} item Instance or UUID
* @return {Object} Returns item object 
*/   
Store.wrap = function wrap(datastore, item){    
  if(typeof(item)=="string"){
    return new datastore.Item({'id': item});          
  } else if(typeof(item)=="object" && !item instanceof datastore.Item){      
    return new datastore.Item(item);  
  }
  return item;
}

/**
* Generate GUID
*
* @method guid
* @return {String} GUID
*/
Store.guid = function guid(separator){
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
               .toString(16)
               .substring(1);
  };
  var sep = separator || '-';
  return s4() + s4() + sep + s4() + sep + s4() + sep +
         s4() + sep + s4() + s4() + s4();
}; 

/**
* Convenience iteration helper
*
* @method times
* @param {Integer} times 
* @return {String} GUID
*/
Store.times = function times(count, callback){
  for(var index=0; index<count; index++) {
    callback(index);
  }
}; 

/**
* Convenience deferred wrapper
*
* @method times
* @param {Integer} times 
* @return {String} GUID
*/
Store.when = function when(callback){
  return _.when(callback);
}; 

/**!
* Stringify object structure (deep!) into url 
*
* @example (borrowed from: http://stackoverflow.com/a/9472534)
*
* // helpers
* var serialized,
*     data = {a: 1, b: 2, c: {d: 4, e: [6, 7, 8], f: {asdf: 10}}};  
*
* // transform
* serialized = Store.serialize(data);
*
* // verify
* console.log(serialized, serialized === "a=1&b=2&c[d]=4&c[e][0]=6&c[e][1]=7&c[e][2]=8&c[f][asdf]=10");
*
* @method serialize
* @return {String} 
*/
Store.serialize = function serialize(params){
  var pairs, proc;
  pairs = [];
  (proc = function(object, prefix) {
    var el, i, key, value, _results;
    if (object == null) object = params;
    if (prefix == null) prefix = null;
    _results = [];
    for (key in object) {
      if (!Object.hasOwnProperty.call(object, key)) continue;
      value = object[key];
      if (value instanceof Array) {
        _results.push((function() {
          var _len, _results2;
          _results2 = [];
          for (i = 0, _len = value.length; i < _len; i++) {
            el = value[i];
            _results2.push(proc(el, prefix != null ? "" + prefix + "[" + key + "][]" : "" + key + "[]"));
          }
          return _results2;
        })());
      } else if (value instanceof Object) {
        if (prefix != null) {
          prefix += "[" + key + "]";
        } else {
          prefix = key;
        }
        _results.push(proc(value, prefix));
      } else {
        _results.push(pairs.push(prefix != null ? "" + prefix + "[" + key + "]=" + value : "" + key + "=" + value));
      }
    }
    return _results;
  })();
  return pairs.join('&');    
};  

// expose
root.Store = Store;  
amdExports = Store;

// call w/scope
}.call(root));
  
  // export *
  return amdExports;

}); 
}(this));
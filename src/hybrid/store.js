(function () { "use strict";
var $estr = function() { return js.Boot.__string_rec(this,''); };
function $extend(from, fields) {
	function inherit() {}; inherit.prototype = from; var proto = new inherit();
	for (var name in fields) proto[name] = fields[name];
	if( fields.toString !== Object.prototype.toString ) proto.toString = fields.toString;
	return proto;
}
var store = {}
store.ItemTypeSafetyTest = function() { }
store.Color = { __constructs__ : ["Red","Green","Blue"] }
store.Color.Red = ["Red",0];
store.Color.Red.toString = $estr;
store.Color.Red.__enum__ = store.Color;
store.Color.Green = ["Green",1];
store.Color.Green.toString = $estr;
store.Color.Green.__enum__ = store.Color;
store.Color.Blue = ["Blue",2];
store.Color.Blue.toString = $estr;
store.Color.Blue.__enum__ = store.Color;
store.Colors = function() { }
store.Colors.toInt = function(c) {
	return (function($this) {
		var $r;
		switch( (c)[1] ) {
		case 0:
			$r = 16711680;
			break;
		case 1:
			$r = 65280;
			break;
		case 2:
			$r = 255;
			break;
		}
		return $r;
	}(this));
}
store.Actions = { __constructs__ : ["create","read","update","delete"] }
store.Actions.create = ["create",0];
store.Actions.create.toString = $estr;
store.Actions.create.__enum__ = store.Actions;
store.Actions.read = ["read",1];
store.Actions.read.toString = $estr;
store.Actions.read.__enum__ = store.Actions;
store.Actions.update = ["update",2];
store.Actions.update.toString = $estr;
store.Actions.update.__enum__ = store.Actions;
store.Actions["delete"] = ["delete",3];
store.Actions["delete"].toString = $estr;
store.Actions["delete"].__enum__ = store.Actions;
store.Base = function() {
	this.namexxx = "test";
};
store.Store = function() {
	this.pending = true;
	store.Base.call(this);
};
store.Store.test = function(test) {
	console.log(test);
}
store.Store.main = function() {
	var resource = new store.plugins.resource.Resource("123");
	var mapping = { create : store.Actions.create, read : store.Actions.read, update : store.Actions.update, 'delete' : store.Actions["delete"]};
	var item = new store.plugins.resource.item.Item("asdasd");
}
store.Store.__super__ = store.Base;
store.Store.prototype = $extend(store.Base.prototype,{
	mirror: function() {
	}
	,isPending: function(pending) {
		if(pending != null) this.pending = pending;
		return this.pending;
	}
	,persist: function(dsn) {
		return true;
	}
	,load: function(dsn) {
	}
	,remove: function(resource) {
	}
	,get: function(resource) {
	}
	,update: function(resource) {
	}
});
store.plugins = {}
store.plugins.resource = {}
store.plugins.resource.Resource = function(data) {
	this.data(data);
};
store.plugins.resource.Resource.prototype = {
	data: function(data) {
		if(data != null) this.__data = data;
		return this.__data;
	}
}
store.plugins.resource.item = {}
store.plugins.resource.item.Item = function(data) {
	store.plugins.resource.Resource.call(this,data);
	console.log("hey there! wazzup???" + data);
};
store.plugins.resource.item.Item.test = function() {
	console.log("testtesttest");
}
store.plugins.resource.item.Item.__super__ = store.plugins.resource.Resource;
store.plugins.resource.item.Item.prototype = $extend(store.plugins.resource.Resource.prototype,{
});
store.plugins.schema = {}
store.plugins.schema.Schema = function() { }
store.plugins.schema.Schema.Validate = function(resource) {
}
store.Store.REQUEST_HEADER_TYPE = "X-Store-Type";
store.Store.RESPONSE_JSONP_ENABLED = true;
store.Store.RESPONSE_JSONP_CALLBACK = "callback";
store.Store.ENTITY_COUNT = "count";
store.Store.ENTITY_IDENTIFIER = "id";
store.Store.MESSAGE_ERROR_DATASTORE_CORRUPT = "DATASTORE IS CORRUPT";
store.Store.MESSAGE_ERROR_DATASTORE_LOCKED = "DATASTORE IS LOCKED";
store.Store.REQUEST_ACTION = "action";
store.Store.REQUEST_NAMESPACE = "namespace";
store.Store.REQUEST_DATA = "instance";
store.Store.REQUEST_JSONP = "jsonp";
store.Store.RESPONSE_ERROR = "error";
store.Store.STORE_ACTION_GET = "get";
store.Store.STORE_ACTION_LIST = "list";
store.Store.STORE_ACTION_REMOVE = "remove";
store.Store.STORE_ACTION_UPDATE = "update";
store.Store.TRANSFER_SOURCE = "tmp_name";
store.Store.TRANSFER_TARGET = "name";
store.Store.main();
})();

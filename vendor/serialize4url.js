// TODO: gather author o fnc on stackoverflow *
(function(root){
// ...
var root.serialize = function serialize(params){
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
})(this);  
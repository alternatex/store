class Client {
  static function display(v) {
    trace(v);
  }
  static function main() {
    var URL = "http://localhost:2000/remoting.n";
    var cnx = haxe.remoting.HttpAsyncConnection.urlConnect(URL);
    cnx.setErrorHandler( function(err) { trace("Error : "+Std.string(err)); } );
    cnx.Server.foo.call([1,5],display);
  }
}

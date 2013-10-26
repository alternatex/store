import haxe.remoting.HttpAsyncConnection; 

class ApiProxy extends haxe.remoting.AsyncProxy<Api> { } 

class ApiClient 
{ 
     static var url:String; 
     static var cnx:HttpAsyncConnection; 
     static var proxy:ApiProxy; 

     static function main() 
     { 
         url = "index.php"; 
         cnx = HttpAsyncConnection.urlConnect(url); 
         proxy =  new ApiProxy(cnx.api); 
         proxy.test(3, 5, display); 

     } 
     static function display(result:Int) 
     { 
         trace ("The server calculated 3 + 5 to equal: " + result); 
     } 

} 
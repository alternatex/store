class Api     { 
     //         // The static members are used to create an instance of this class, and share it for remoting         // 
     static var instance : Api; 

     static function main() 
     { 
         instance = new Api(); 
       // create an incoming connection and give access to the "instance" object 
         var context = new haxe.remoting.Context(); 
         context.addObject("api",instance); 
         haxe.remoting.HttpConnection.handleRequest(context); 
     } 

    //         // The rest of the members are available to remoting         // 

     private var loginOkay:Bool; 
     private var username:String; 

     public function new()         { 
        #if php 
        // php code goes goes here, I will usually check here that they are logged in correctly 
        #end 
     } 

     public function test(x : Int, y : Int) : Int 
     { 
         return x + y; 
     } 

} 

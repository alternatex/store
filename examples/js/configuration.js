define(["store"], function(Store){

  // global configuration
  Store.configure({
    url: "./server.php"
  });

  // initialize custom stores
  ['resources', 'document', 'user', 'article'].forEach(function(context){
    window[context.toLowerCase()+'Store'] = new Store({ namespace: context });
  });
  
});
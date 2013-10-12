define(["jquery", "store", "require.store", "underscore", "configuration" , "data", "shop"], function($, Store, res, u, conf, data, shop) {

  console.log("data:", data);
  console.log("shop:", shop);

  _.when(resourcesStore.list()).done(function(data){
    console.log((data));
  }); 

  return true;
       
});

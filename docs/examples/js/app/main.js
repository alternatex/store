define(["jquery", "store", "require.store", "underscore", "configuration"], function($, Store) {            
  _.when(documentStore.list()).done(function(data){
    console.log((data));
  });        
});

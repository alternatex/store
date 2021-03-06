requirejs.config({
    "baseUrl": "js/lib",
    "deps": ["jquery", "underscore", "store"],
    "paths": {
      "app": "../app",
      "store": "../../../src/client/store",
      "configuration": "../configuration",
      "underscore": "../underscore.deferred",
      "jquery": "//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min",
      "data": "//localhost/store/examples/data/data.php",
      "shop": "//localhost/store/examples/data/shop.php"
    },
    "shim": {
      "underscore": {
        "exports" : "_"
      }
    }
});

requirejs(["app/main"]);
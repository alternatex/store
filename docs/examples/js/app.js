// Place third party dependencies in the lib folder
//
// Configure loading modules from the lib directory,
// except 'app' ones, 
requirejs.config({
    "baseUrl": "js/lib",
    "deps": ["jquery", "underscore", "store"],
    "paths": {
      "app": "../app",
      "store": "../../../../src/client/store",
      "configuration": "../../configuration",
      "underscore": "../../../../vendor/underscore.deferred",
      "jquery": "//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min"
    },
    "shim": {
      "underscore": {
        "exports" : "_"
      }
    }
});

// Load the main app module to start the app
requirejs(["app/main"]);

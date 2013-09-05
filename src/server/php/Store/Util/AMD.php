<?php

function printDataAsCommonJSModule($key, $data){
  header('content-type: application/javascript');
  print str_replace(array("\n", "\t", "   ", "   ", "  "), "","
(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    define(factory);
  } else {
    root.".$key." = factory();
  }
}(this, function () {
  return ".json_encode($data).";
}));");  
}
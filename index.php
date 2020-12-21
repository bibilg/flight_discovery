<?php

require "vendor/autoload.php";

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/hello/@name', function($name){
    echo "hello, $name!";
});


Flight::start();
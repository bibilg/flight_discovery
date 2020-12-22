<?php

require "vendor/autoload.php";

Flight::route('/', function(){
    echo 'Hello world!';
});

Flight::route('/hello/@name', function($name){
    echo "Hello, $name!";
});


Flight::start();
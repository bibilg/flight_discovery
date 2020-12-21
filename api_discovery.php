<?php

require "vendor/autoload.php";

$response = Requests::get('https://medusa.delahayeyourself.info/api/books/');

//var_dump($response->body); // We can see the body of the API
 
//var_dump($response->status_code); // We can see ce status-code of a request

$books = json_decode($response->body);

require "view/main.php";
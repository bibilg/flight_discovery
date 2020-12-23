<?php

require "vendor/autoload.php";

// Load and configure twig
$loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__) . '/views');
$twigConfig = array(
    // 'cache' => './cache/twig/',
    // 'cache' => false,
    'debug' => true,
);

// Allow Flight to use twig :
Flight::register('view', '\Twig\Environment', array($loader, $twigConfig), function ($twig) {
    $twig->addExtension(new \Twig\Extension\DebugExtension()); // Add the debug extension
    $twig->addGlobal('ma_valeur', "Hello There!"); // Can use 'ma_valeur' in all twig views

    $twig->addFilter(new \Twig\TwigFilter('trad', function($string){
        return $string;
    })); // Filter how 
});

//For call more simply the views
Flight::map('render', function($template, $data=array()){

    Flight::view()->display($template, $data);
    // After that, we can write : Flight::render('child_view.twig');
    
});

/* ----- Starting routing ------*/

Flight::route('/', function(){
    echo 'Hello world!';
});

Flight::route('/hello/@name', function($name){
    echo "Hello, $name!";
});


Flight::route('/first_view/', function(){
    $data = [ // data is an array 
        'contenu' => 'Hello World!',
        'name' => 'Ben Kenobi',
        'tab' => array( // tab is an array in data
            "key" => "content test",
            "key2" => "content2"
        )
    ];
    Flight::view()->display('first_view.twig', $data);
});

Flight::route('/view_with_template', function(){

   // Flight::view()->display('child_view.twig'); or :
    Flight::render('child_view.twig');

});

Flight::start();
<?php

require "vendor/autoload.php";

// Load and configure twig
$loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__) . '/views');
$twigConfig = array(
    // 'cache' => './cache/twig/',
    // 'cache' => false,
    'debug' => true,
);

// Filter how connect a data base 
Flight::before('start', function(&$params, &$output){
    ORM::configure('sqlite:tweets.sqlite3');
});

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

    $books = getBooks();
    $foo='Hello';

    Flight::render('apiBooksView.twig', array(
        'books' => $books,
        'foo' => $foo
    ));

});

Flight::route('/hello/@name', function($name){
    echo "Hello, $name!";
});


Flight::route('/first_view', function(){
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

Flight::route('/markdown_test', function(){
    echo renderHTMLFromMarkdown(readFileContent('pages/test.md'));
});

Flight::route('/users', function(){

    $users = User::find_many();

    Flight::render('users.twig', array(
        'users' => $users
    ));
});

Flight::route('/tweets', function(){

    $liste_tweets = Tweet::liste_tweets();
    $tests = Tweet::join('users' , array('users.id' , '=' , 'tweets.user_id'))
    ->find_many();

    Flight::render('tweets.twig', array(
        'tweets' => $liste_tweets,
        'tests' => $tests
    ));
});


Flight::route('/tweets/@username', function($username){

    // SELECT * FROM users WHERE username = $username;
    $user = User::where('username' , $username)
    ->findOne();

    // SELECT * FROM tweets WHERE user_id = $user->id;
    $tweets = Tweet::where('user_id' , $user->id)
    ->find_many();
    // or $tweets = $user->tweets()->find_many(); // See function in models
    
    Flight::render('tweetsUser.twig', array(
            'tweets' => $tweets,
            'user' => $user
    ));
});

Flight::route('/api/helloworld', function(){
    $data = [
        'data' => 'Hello World!',
    ];
    Flight::json($data);
});

Flight::route('/api/helloworld/@name', function($name){
    $data = array(
        'data' => 'Hello ' . $name
    );
    Flight::json($data);
});

Flight::route('/api/users', function(){

    $data = array(
    );

    $users = User::find_many();

    foreach($users as $user)
    {
        array_push(
            $data,array(
                'name' => $user->name,
                'firstname' => $user->firstname,
                'username' => $user->username
            )
        );
    }


    Flight::json($data);
});



Flight::start();
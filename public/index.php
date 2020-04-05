<?php

    require_once(dirname(__FILE__, 2) . '/src/config/config.php');
    
 

    $uri = urldecode(
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
    );

    if($uri === '/' || $uri === '' || $uri === '/index.php' ){
        $uri = '/day_records.php';
    }

    require_once(CONTROLLER_PATH . "/{$uri}");

// require_once(CONTROLLER_PATH . '/day_records.php');

// Testar a view
// loadView('login', ['texto' => 'abc123']);



//aula 249 -: teste de login
// require_once(MODEL_PATH . '/Login.php');

// $login = new Login([
//     'email' => 'admin@cod3r.com.br',
//     'password' => 'a'
// ]);

// try {
//     $login->checkLogin();
//     echo 'Deu certo';
// } catch(Exception $e) {
//     echo 'Problema no login :P';
// }


//aula 247--------


// $user = new User(['name' => 'Lucass', 'email' => 'lucas@cod3r.com.br']);


// print_r(User::get(['id' => 1], 'name, email'));
// echo '<br><br>';

// print_r($user->get(['id' => 1], 'name, email'));
// echo '<br><br>';

// print_r($user->get([], 'name'));
// echo '<br><br>';


// foreach($user->get([], 'name') as $user) {
//     echo $user->name;
//     echo '<br>';
// }


// echo $user->get(['id' => 1], 'name, email');
// echo '<br>';
// echo $user->get(['name' => 'Chaves', 'email' => 'chaves@cod3r.com.br']);


//aula 245--------

// print_r($user);
// echo '<br><br>';
// $user->email = 'lucas_alteradow@cod3r.com.br';
// print_r($user->email);


//aula inicial:--------
// $sql = 'select * from users';
// $result = Database::getResultFromQuery($sql);
// while($row = $result->fetch_assoc()) {
//     print_r($row);
//     echo '<br>';
// }
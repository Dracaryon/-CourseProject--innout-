<?php

// echo 'login controller...';

loadModel('Login');
SESSION_START();
 $exception = null;

if(count($_POST) > 0) { //significa que acabei de submeter uma requisição do tipo post
    $login = new Login($_POST);
    try{
        $user = $login->checkLogin();
        $_SESSION['user'] = $user;
        header("Location: day_records.php");
    } catch(AppException $e) {
        $exception = $e;
    }

}

//loadView('login'); e no view(login.php)//value="<?= $_POST['email'];
//ou

loadView('login', $_POST + ['exception' => $exception]);

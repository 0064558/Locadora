<?php
    require('config.php');
    require('helper/User.php');

    $email = filter_input(INPUT_POST, 'email');
    $pass = filter_input(INPUT_POST, 'pass');

    if($email && $pass){

        $user = new User($pdo, $base);
        $token = $user->verificarLogin($email, $pass);

        $_SESSION['token'] = $token;
        header('Location: '.$base);
        exit;

    }else{
        $_SESSION['flash'] = 'Envie todos os campos';
    }

    header('Location: '.$base.'/login.php');
    exit;
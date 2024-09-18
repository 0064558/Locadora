<?php
    require('config.php');
    require('helper/User.php');

    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $acesso = filter_input(INPUT_POST, 'acesso');

    if($nome && $email && $acesso && $id){
        
        $user = new User($pdo, '');
        $user->edit($nome, $email, $acesso, $id);

        $_SESSION['flash'] = 'SUCESSO: Usuario Editado com sucesso';
    }else{
        $_SESSION['flash'] = 'ERROR: envie todos os campos';
    }


    header('location: '.$base.'/usuario.php');
    exit;
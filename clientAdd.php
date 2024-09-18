<?php
    require('config.php');
    require('helper/Cliente.php');

    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $telefone = filter_input(INPUT_POST, 'telefone');

    if($nome && $email && $cpf && $telefone){
        
        $cliente = new Cliente($pdo);
        $cliente->novo($nome, $email, $cpf, $telefone);

        $_SESSION['flash'] = 'Campos adicionados com sucesso';
    }else{
        $_SESSION['flash'] = 'envie todos os campos';
    }


    header('location: '.$base.'/cliente.php');
    exit;
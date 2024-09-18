<?php
    require('config.php');
    require('helper/Cliente.php');

    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $telefone = filter_input(INPUT_POST, 'telefone');

    if($nome && $email && $cpf && $telefone && $id){
        
        $cliente = new Cliente($pdo);
        $cliente->edit($nome, $email, $cpf, $telefone, $id);

        $_SESSION['flash'] = 'SUCESSO: Campos adicionados com sucesso';
    }else{
        $_SESSION['flash'] = 'ERROR: envie todos os campos';
    }


    header('location: '.$base.'/cliente.php');
    exit;
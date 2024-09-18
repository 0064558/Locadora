<?php
    require('config.php');
    require('helper/Cliente.php');

    $id = filter_input(INPUT_POST, 'id');

    if($id){


        $cliente = new Cliente($pdo);
        $cliente->delete($id);

        $_SESSION['flash'] = 'SUCESSO: Item deletado com sucesso';
    }else{
        $_SESSION['flash'] = 'ERRO: Erro ao identificar o item.';
    }


    header('Location: '.$base.'/cliente.php');
    exit;
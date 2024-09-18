<?php
    require('config.php');
    require('helper/Emprestimo.php');

    $idLivro = filter_input(INPUT_POST, 'idLivro');
    $idCliente = filter_input(INPUT_POST, 'idCliente');
    $data = filter_input(INPUT_POST, 'data');

    if($idLivro && $idCliente && $data){
        
        $emprestimo = new Emprestimo($pdo);
        $emprestimo->novo($idLivro, $idCliente, $data);

        $_SESSION['flash'] = 'Emprestimo adicionados com sucesso';
    }else{
        $_SESSION['flash'] = 'envie todos os campos';
    }


    header('location: '.$base.'/emprestimo.php');
    exit;
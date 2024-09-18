<?php
    require('config.php');
    require('helper/Emprestimo.php');

    $idLivro = filter_input(INPUT_POST, 'idLivro');
    $idCliente = filter_input(INPUT_POST, 'idCliente');
    $data = filter_input(INPUT_POST, 'data');
    $id = filter_input(INPUT_POST, 'id');

    if($idLivro && $idCliente && $data && $id){
        
        $emprestimo = new Emprestimo($pdo);
        $emprestimo->editarEmprestimo($id, $idLivro, $idCliente, $data);

        $_SESSION['flash'] = 'Emprestimo editado com sucesso';
    }else{
        $_SESSION['flash'] = 'envie todos os campos';
    }


    header('location: '.$base.'/emprestimo.php');
    exit;
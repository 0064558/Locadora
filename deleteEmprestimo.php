<?php
    require('config.php');
    require('helper/Emprestimo.php');

    $id = filter_input(INPUT_POST, 'id');

    if($id){


        $emprestimo = new Emprestimo($pdo);
        $emprestimo->delete($id);

        $_SESSION['flash'] = 'SUCESSO: Emprestimo deletado com sucesso';
    }else{
        $_SESSION['flash'] = 'ERRO: Erro ao identificar o item.';
    }


    header('Location: '.$base.'/emprestimo.php');
    exit;
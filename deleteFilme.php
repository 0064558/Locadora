<?php
    require('config.php');
    require('helper/Filme.php');

    $id = filter_input(INPUT_POST, 'id');

    if($id){


        $filme = new Filme($pdo);
        $filme->delete($id);

        $_SESSION['flash'] = 'SUCESSO: Item deletado com sucesso';
    }else{
        $_SESSION['flash'] = 'ERRO: Erro ao identificar o item.';
    }


    header('Location: '.$base.'/filmes.php');
    exit;
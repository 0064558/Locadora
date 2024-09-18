<?php
    require('config.php');
    require('helper/Filme.php');

    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $autor = filter_input(INPUT_POST, 'autor');
    $ano = filter_input(INPUT_POST, 'ano');

    if($nome && $tipo && $autor && $ano && $id){
        
        $filme = new Filme($pdo);
        $filme->edit($id, $nome, $tipo, $autor, $ano);

        $_SESSION['flash'] = 'Filme editado com sucesso';
    }else{
        $_SESSION['flash'] = 'envie todos os campos';
    }


    header('location: '.$base.'/filmes.php');
    exit;
<?php
    require('config.php');
    require('helper/Filme.php');

    $nome = filter_input(INPUT_POST, 'nome');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $autor = filter_input(INPUT_POST, 'autor');
    $ano = filter_input(INPUT_POST, 'ano');

    if($nome && $tipo && $autor && $ano){
        
        $filme = new Filme($pdo);
        $filme->novo($nome, $tipo, $autor, $ano);

        $_SESSION['flash'] = 'Filme adicionado com sucesso';
    }else{
        $_SESSION['flash'] = 'envie todos os campos';
    }


    header('location: '.$base.'/filmes.php');
    exit;
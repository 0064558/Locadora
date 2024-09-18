<?php
    require('config.php');
    require('helper/User.php');
    
    $idloggeduser = filter_input(INPUT_POST, 'idloggeduser');
    $id = filter_input(INPUT_POST, 'id');

    if($id && $idloggeduser){

        if($id == $idloggeduser) {
            $_SESSION['flash'] = 'ERRO: Não é possível deletar sua própria conta.';
            header('Location: '.$base.'/usuario.php');
            exit;
        }

      
        $user = new User($pdo, '');
        $user->delete($id);

        $_SESSION['flash'] = 'SUCESSO: usuario deletado com sucesso';
    }else{
        $_SESSION['flash'] = 'ERRO: Erro ao identificar o Ususario.';
    }


    header('Location: '.$base.'/usuario.php');
    exit;
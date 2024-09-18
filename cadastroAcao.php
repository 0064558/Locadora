<?php
    require('config.php');
    require('helper/User.php');

    $nome_usuario = filter_input(INPUT_POST, 'username');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'password');
    $confirmarsenha = filter_input(INPUT_POST, 'confirmpassword');

    if($nome_usuario && $email && $senha && $confirmarsenha){

        if($senha == $confirmarsenha){

            $user = new User($pdo, $base); // criando objeto de usuário para criar um novo usuário

            if(!$user->emailExists($email)){ // verifica se o email já existe

                $token = $user->register($nome_usuario, $email, $senha); // se não existir irá criar um token 
            
                $_SESSION['token'] = $token; // define o token
                
                header('Location: '.$base); // mandando de volta para a base
                exit; // garantir que o código ira mandar pra outra tela
            }else{
                $_SESSION['flash'] = 'Email já existe'; // se existir um email retorna uma mensagem
            }

        }else{
            $_SESSION['flash'] = 'Senhas não coincidem'; // se as senhas forem diferente retorna uma mensagem
        }

    }else{
        $_SESSION['flash'] = 'Envie todos os campos'; // se deixar alguma coisa em branco retorna uma mensagem
    }

    
    header('Location: '.$base.'/cadastro.php'); // manda de volta para cadastro.php
    exit; // garantir que o código ira mandar pra outra tela
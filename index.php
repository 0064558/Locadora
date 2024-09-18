<?php
    require("config.php");
    require("helper/Helper.php");

    if(empty($_SESSION['token'])){
        header('location: '.$base.'/login.php');
        exit;
    }

    $helper = new Helper($pdo, $base);
    $loggedUser = $helper->checkToken($_SESSION['token']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="./index.css">
    <script src="https://kit.fontawesome.com/7c40fa45d0.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="botaoContainer">
    <h1>Tela Inicial</h1>
    <h1>Bem-Vindo <?=$loggedUser['nome']?></h1>
    <a href="./cliente.php"><button class="menu-button" onclick="irPara('cliente')">Clientes</button></a>
    <a href="<?=$loggedUser['acesso'] == 1 ? '#Acesso-negado' : './usuario.php'?>"><button class="menu-button" onclick="irPara('usuario')">Usuários <?=$loggedUser['acesso'] == 1 ? ' <i class="fa-solid fa-lock"></i>' : ''?></button></a>
    <a href="./emprestimo.php"><button class="menu-button" onclick="irPara('emprestimo')">Empréstimos</button></a>
    <a href="./filmes.php"><button class="menu-button" onclick="irPara('livro')">Filmes</button></a>
    <a href="./logout.php"><button class="menu-button" onclick="irPara('cadastro')">Sair</button></a>
</div>

</body>
</html>
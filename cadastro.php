<?php
    // Inclusão do arquivo de configuração
    require('config.php');

    // Verifica se já existe um token de sessão
    if(!empty($_SESSION['token'])){
        // Redireciona para a página inicial se o token já estiver presente
        header('location: '.$base);
        exit;
    }

    // Inicialização de variável para mensagens de flash
    $flash = '';
    // Verifica se há mensagens de flash na sessão
    if(!empty($_SESSION['flash'])){
        // Atribui a mensagem de flash e limpa a variável na sessão
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    <!-- Inclusão do arquivo de estilo -->
    <link rel="stylesheet" href="./cadastro.css">
</head>
<body>

<div class="titulo_cadastro">
    <!-- Título da página de cadastro -->
    <h2>Cadastrar</h2>

    <?php if(!empty($flash)): ?>
        <!-- Exibe mensagens de flash, se houver -->
        <p class="flashError"><?=$flash?></p>
    <?php endif; ?>

    <!-- Formulário de cadastro -->
    <form method="POST" action="./cadastroAcao.php" class="login">
        <!-- Grupo de entrada de usuário -->
        <div class="grupo">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username">
        </div>
        <!-- Grupo de entrada de email -->
        <div class="grupo">
            <label for="password">Email:</label>
            <input type="email" id="password" name="email" required>
        </div>
        <!-- Grupo de entrada de senha -->
        <div class="grupo">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <!-- Grupo de confirmação de senha -->
        <div class="grupo">
            <label for="password">Confirmar Senha:</label>
            <input type="password" id="password" name="confirmpassword" required>
        </div>
        <!-- Link para página de login -->
        <a href="<?=$base;?>/login.php">Já tenho conta</a>
        <!-- Botão de envio do formulário -->
        <button type="submit">Cadastrar</button>
    </form>
</div>

</body>
</html>

<?php
    require('config.php');

    if(!empty($_SESSION['token'])){
        header('location: '.$base);
        exit;
    }

    $flash = '';
    if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="./login.css">
</head>

<body>

<div class="login-container">
    <h2>Login</h2>
    
    <?php if(!empty($flash)): ?>
        <p class="flashError"><?=$flash?></p>
    <?php endif; ?>

    <form class="login-form" method="POST" action="./login_action.php">
        <div class="form-group">
            <label for="username">E-mail:</label>
            <input type="text" id="username" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="pass" required>
        </div>
        <a href="<?=$base?>/cadastro.php">Não tenho conta</a>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>

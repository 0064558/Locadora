<?php
    require("config.php");
    require("helper/Helper.php");
    require("helper/User.php");

    if(empty($_SESSION['token'])){
        header('location: '.$base.'/login.php');
        exit;
    }

    $helper = new Helper($pdo, $base);
    $loggedUser = $helper->checkToken($_SESSION['token']);

    $flash = '';
    if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }

    $userDao = new User($pdo, $base);
    $user = $userDao->getUserData();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Usuários</title>
    <link rel="stylesheet" href="./usuario.css">

</head>

<body>

<div class="table-container">
    <h1>Tela de Usuários</h1>
    <p>Bem-Vindo administrador, <?=$loggedUser['nome']?></p>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Acesso</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($user as $userSingle): ?>
                <tr class="item">
                    <td class="trId"><?=$userSingle['id']?></td>
                    <td class="trNome"><?=$userSingle['nome']?></td>
                    <td class="trEmail"><?=$userSingle['email']?></td>
                    <td class="trAcesso"><?=$userSingle['acesso']?></td>
                    <td class="action-buttons">
                        <button class="editBtn">Editar</button>
                        <button onclick="excluir(<?=$userSingle['id']?>)">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
           
        </tbody>
    </table>
    <a href="<?=$base;?>">Voltar</a>

    <?php if(!empty($flash)): ?>
        <p class="flashError"><?=$flash ? $flash : '' ;?></p>
    <?php endif; ?>
</div>


<form action="<?=$base;?>/deleteUser.php" method="POSt" class="formDeleteUser">
    <input type="hidden" name="id">
    <input type="hidden" name="idloggeduser" value="<?=$loggedUser['id']?>" >
</form>

<div class="bgDarkEdit">
    <form class="modal" method="POST" action="<?=$base;?>/usuarioEdit.php">
        <h2>EDITAR CLIENTE</h2>
        <input class="inputId" type="hidden" name="id">
        <input class="inputName" type="text" name="nome" placeholder="nome">
        <input class="inputEmail" type="text" name="email" placeholder="email">
        <input class="inputAcesso" type="text" name="acesso" placeholder="acesso">

        <button class="closeModalEdit">fechar</button>
        <button>Editar</button>
    </form>
</div>



<script>
    
    let item = document.querySelectorAll('.item');
    let buttonEdit = document.querySelectorAll('.action-buttons .editBtn');
    
    for(let i = 0; i < item.length; i++){
        buttonEdit[i].addEventListener('click', ()=>{
            let id = item[i].querySelector('.trId').textContent;
            let name = item[i].querySelector('.trNome').textContent;
            let email = item[i].querySelector('.trEmail').textContent;
            let acesso = item[i].querySelector('.trAcesso').textContent;

            document.querySelector('.inputId').value = id;
            document.querySelector('.inputName').value = name;
            document.querySelector('.inputEmail').value = email;
            document.querySelector('.inputAcesso').value = acesso;

            document.querySelector('.bgDarkEdit').style.display = 'flex';
        })
    }


    document.querySelector('.closeModalEdit').addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.bgDarkEdit').style.display = 'none';
    });



    function excluir(id) {
        document.querySelector('.formDeleteUser input').value = id;
        document.querySelector('.formDeleteUser').submit();
    }
</script>

</body>
</html>

<?php
    require("config.php");
    require("helper/Helper.php");
    require("helper/Cliente.php");

    if(empty($_SESSION['token'])){
        header('location: '.$base.'/login.php');
        exit;
    }

    
    $helper = new Helper($pdo, $base);
    $usuarioLogado = $helper->checkToken($_SESSION['token']);

    $clientesDao = new Cliente($pdo);
    $cliente = $clientesDao->getAll();



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
    <title>Tela de Clientes</title>
    <link rel="stylesheet" href="./cliente.css">
</head>

<body>

<div class="table">
    <h1>Tela de Clientes</h1>
    <p>Logado como <?=$usuarioLogado['nome'];?></p>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cliente as $clienteSingle): ?>
                <tr class="item">
                    <td class="trId"><?=$clienteSingle['id']?></td>
                    <td class="trName"><?=$clienteSingle['nome']?></td>
                    <td class="trEmail"><?=$clienteSingle['email']?></td>
                    <td class="trCpf"><?=$clienteSingle['cpf']?></td>
                    <td class="trTelefone"><?=$clienteSingle['telefone']?></td>
                    <td class="botoes">
                        <button class="editBtn">Editar</button>
                        <button class="deleteBtn" onClick="deletar(<?=$clienteSingle['id']?>)">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?=$base;?>">Voltar</a>
    <button class="add-button" >Adicionar Novo</button>
    <p><?=$flash ? $flash : '' ;?></p>
</div>

<div class="bgDarkEdit">
    <form class="modal" method="POST" action="<?=$base;?>/clientEdit.php">
        <h2>EDITAR CLIENTE</h2>
        <input class="inputId" type="hidden" name="id">
        <input class="inputName" type="text" name="nome" placeholder="nome">
        <input class="inputEmail" type="text" name="email" placeholder="email">
        <input class="inputCpf" type="text" name="cpf" placeholder="cpf">
        <input class="inputTelefone" type="text" name="telefone" placeholder="telefone">
        <button class="closeModalEdit">fechar</button>
        <button>Editar</button>
    </form>
</div>

<div class="bgDark">
    <form class="modal" method="POST" action="<?=$base;?>/clientAdd.php">
        <h2>ADICIONAR NOVO CLIENTE</h2>
        <input type="text" name="nome" placeholder="nome">
        <input type="text" name="email" placeholder="email">
        <input type="text" name="cpf" placeholder="cpf">
        <input type="text" name="telefone" placeholder="telefone">
        <button class="closeModal">fechar</button>
        <button>Adicionar</button>
    </form>
</div>

<form class="deleteForm" action="<?=$base;?>/deleteClient.php" method="POST">
    <input type="hidden" name="id" class="deleteInput" >
</form>

<script>
    let url = '<?=$base?>';

    let deleteForm = document.querySelector('.deleteForm');

    function deletar(id){
        document.querySelector('.deleteInput').value = id;
        deleteForm.submit();

    }


    let item = document.querySelectorAll('.item');
    let buttonEdit = document.querySelectorAll('.botoes .editBtn');

    for(let i = 0; i < item.length; i++){
        buttonEdit[i].addEventListener('click', ()=>{
            let id = item[i].querySelector('.trId').textContent;
            let name = item[i].querySelector('.trName').textContent;
            let email = item[i].querySelector('.trEmail').textContent;
            let telefone = item[i].querySelector('.trTelefone').textContent;
            let cpf = item[i].querySelector('.trCpf').textContent;

            document.querySelector('.inputId').value = id;
            document.querySelector('.inputName').value = name;
            document.querySelector('.inputEmail').value = email;
            document.querySelector('.inputTelefone').value = telefone;
            document.querySelector('.inputCpf').value = cpf;

            document.querySelector('.bgDarkEdit').style.display = 'flex';
        })
    }

    let closeModalEdit = document.querySelector('.closeModalEdit');

    closeModalEdit.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.bgDarkEdit').style.display = 'none';
    });

   
    let addButton = document.querySelector('.add-button');

    addButton.addEventListener('click', () => {
        document.querySelector('.bgDark').style.display = 'flex';
    });

    let closeModal = document.querySelector('.closeModal');

    closeModal.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.bgDark').style.display = 'none';
    });

</script>
</body>
</html>
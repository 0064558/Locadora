<?php
    require("config.php");
    require("helper/Helper.php");
    require("helper/Emprestimo.php");

    if(empty($_SESSION['token'])){
        header('location: '.$base.'/login.php');
        exit;
    }

    $helper = new Helper($pdo, $base);
    $usuarioLogado = $helper->checkToken($_SESSION['token']);

    $flash = '';
    if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }

    $emprestimoDao = new Emprestimo($pdo);
    $emprestimo = $emprestimoDao->getAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Emprestimo</title>
    <link rel="stylesheet" href="./emprestimo.css">
</head>

<body>

<div class="table-container">
    <h1>Tela de Empréstimos</h1>
    <p>Bem-Vindo, <?=$usuarioLogado['nome'];?></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID do Filme</th>
                <th>ID do Cliente</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($emprestimo as $emprestimoSingle): ?>
                <tr class="item">
                    <td class="trId"><?=$emprestimoSingle['id']?></td>
                    <td class="trIdCliente"><?=$emprestimoSingle['id_cliente']?></td>
                    <td class="trIdLivro"><?=$emprestimoSingle['id_livro']?></td>
                    <td class="trData"><?=$emprestimoSingle['data_emprestimo']?></td>
                    <td class="action-buttons">
                        <button class="editBtn">Editar</button>
                        <button onclick="excluir(<?=$emprestimoSingle['id']?>)">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
    <a href="<?=$base;?>">Voltar</a>
    <button class="add-button" onclick="adicionar()">Adicionar Novo</button>
    <p><?=$flash ? $flash : ''?></p>
</div>




<div class="bgDark">
    <form class="modal" method="POST" action="<?=$base;?>/emprestimoAdd.php">
        <h2>ADICIONAR NOVO EMPRESTIMO</h2>
        <input type="hidden" name="id">
        <input type="text" name="idCliente" placeholder="id cliente">
        <input type="text" name="idLivro" placeholder="id Filme">
        <input type="text" name="data" placeholder="data">

        <button class="closeModal">fechar</button>
        <button class="openToAdd">Adicionar</button>
    </form>
</div>

<div class="bgDarkEdit">
    <form class="modal" method="POST" action="<?=$base;?>/emprestimoEdit.php">
        <h2>EDITAR EMPRESTIMO</h2>
        <input type="hidden" class="inputId" name="id">
        <input type="text" class="inputIdCliente" name="idCliente" placeholder="id cliente">
        <input type="text" class="inputIdLivro" name="idLivro" placeholder="id Filme">
        <input type="text" class="inputData" name="data" placeholder="data">

        <button class="closeModalEdit">fechar</button>
        <button class="openToAdd">Editar</button>
    </form>
</div>

<form class="deleteEmprestimo" method="POST" action="<?=$base?>/deleteEmprestimo.php">
    <input type="hidden" name="id">
</form>


<script>

    let closeModalEdit = document.querySelector('.closeModalEdit');

    closeModalEdit.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.bgDarkEdit').style.display = 'none';
    });

    let item = document.querySelectorAll('.item');
    let buttonEdit = document.querySelectorAll('.action-buttons .editBtn');

    for(let i = 0; i < item.length; i++){
        buttonEdit[i].addEventListener('click', ()=>{

            let id = item[i].querySelector('.trId').textContent;
            let idLivro = item[i].querySelector('.trIdLivro').textContent;
            let idCliente = item[i].querySelector('.trIdCliente').textContent;
            let data = item[i].querySelector('.trData').textContent;

            document.querySelector('.inputId').value = id;
            document.querySelector('.inputIdLivro').value = idLivro;
            document.querySelector('.inputIdCliente').value = idCliente;
            document.querySelector('.inputData').value = data;

            document.querySelector('.bgDarkEdit').style.display = 'flex';
        })
    }


    function excluir(id) {
        document.querySelector('.deleteEmprestimo input').value = id;
        document.querySelector('.deleteEmprestimo').submit();
    }

    function adicionar(){
        document.querySelector('.bgDark').style.display = 'flex';
    }

    document.querySelector('.closeModal').addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector('.bgDark').style.display = 'none';
    })

</script>

</body>
</html>

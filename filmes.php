<?php
    require("config.php");
    require("helper/Helper.php");
    require("helper/Filme.php");

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

    $filmesDao = new Filme($pdo);
    $filme = $filmesDao->getAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Filmes</title>
    <link rel="stylesheet" href="./filmes.css">
</head>

<body>

<div class="table-container">
    <h1>Tela de Filmes</h1>
    <p>Bem-Vindo, <?=$loggedUser['nome']?></p>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Diretor</th>
                <th>Ano</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($filme as $filmesSingle): ?>
                <tr class="item">
                    <td class="trId"><?=$filmesSingle['id']?></td>
                    <td class="trNome"><?=$filmesSingle['nome']?></td>
                    <td class="trTipo"><?=$filmesSingle['tipo']?></td>
                    <td class="trAutor"><?=$filmesSingle['autor']?></td>
                    <td class="trAno"><?=$filmesSingle['ano']?></td>
                    <td class="action-buttons">
                        <button class="editBtn">Editar</button>
                        <button onclick="excluir(<?=$filmesSingle['id']?>)">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
    
    <a href="<?=$base;?>">Voltar</a>
    <button class="add-button">Adicionar Novo</button>
    <p> <?=$flash ? $flash : '' ?> </p>
</div>



<div class="bgDark">
    <form class="modal" method="POST" action="<?=$base;?>/filmeAdd.php">
        <h2>ADICIONAR NOVO FILME</h2>
        <input type="hidden" name="id">
        <input type="text" name="nome" placeholder="nome">
        <input type="text" name="tipo" placeholder="tipo">
        <input type="text" name="autor" placeholder="autor">
        <input type="text" name="ano" placeholder="ano">
        <button class="closeModal">fechar</button>
        <button class="openToAdd">Adicionar</button>
    </form>
</div>

<div class="bgDarkEdit">
    <form class="modal" method="POST" action="<?=$base;?>/filmeEdit.php">
        <h2>ADICIONAR NOVO FILME</h2>
        <input type="hidden" name="id">
        <input class="inputId" type="hidden" name="id">
        <input class="inputNome" type="text" name="nome" placeholder="nome">
        <input class="inputTipo" type="text" name="tipo" placeholder="tipo">
        <input class="inputAutor" type="text" name="autor" placeholder="autor">
        <input class="inputAno" type="text" name="ano" placeholder="ano">
        <button class="closeModalEdit">fechar</button>
        <button class="openToAdd">Adicionar</button>
    </form>
</div>


<form class="deleteForm" action="<?=$base;?>/deleteFilme.php" method="POST">
    <input type="hidden" name="id" class="deleteInput" >
</form>

<script>

    let item = document.querySelectorAll('.item');
    let buttonEdit = document.querySelectorAll('.action-buttons .editBtn');

    for(let i = 0; i < item.length; i++){
        buttonEdit[i].addEventListener('click', ()=>{
            let id = item[i].querySelector('.trId').textContent;
            let name = item[i].querySelector('.trNome').textContent;
            let tipo = item[i].querySelector('.trTipo').textContent;
            let autor = item[i].querySelector('.trAutor').textContent;
            let ano = item[i].querySelector('.trAno').textContent;

            document.querySelector('.inputId').value = id;
            document.querySelector('.inputNome').value = name;
            document.querySelector('.inputTipo').value = tipo;
            document.querySelector('.inputAutor').value = autor;
            document.querySelector('.inputAno').value = ano;

            document.querySelector('.bgDarkEdit').style.display = 'flex';
        })
    }

    document.querySelector('.closeModalEdit').addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.bgDarkEdit').style.display = 'none';
    })



    document.querySelector('.add-button').addEventListener('click', () => {
        document.querySelector('.bgDark').style.display = 'flex';
    });

    document.querySelector('.closeModal').addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.bgDark').style.display = 'none';
    });

    function editar() {
       
        console.log('Editar');
    }

    function excluir(id) {
        document.querySelector('.deleteForm input').value = id;
        document.querySelector('.deleteForm').submit();
    }
</script>

</body>
</html>

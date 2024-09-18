<?php
$servername = "localhost"; //nome do servidor
$username = "root"; //nome do usuário do banco de dados
$password = "123456"; //senha do usuário do banco de dados
$dbname = "locadora"; //nome do banco de dados
session_start();
$base = 'http://localhost/locadora';

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

try{
    $pdo = new PDO("mysql:dbname=".$dbname.";host=".$servername, $username, $password);
}catch(PDOException $e){
    echo "It was not possible to connect to the database. Erro: " . $e->getMessage();
}
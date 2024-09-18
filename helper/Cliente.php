<?php

class Cliente {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAll(){

        $sql = $this->pdo->query("SELECT * FROM cliente");
        
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function novo($nome, $email, $cpf, $telefone){

        $sql = $this->pdo->prepare("INSERT INTO cliente (nome, email, cpf, telefone) VALUES (:nome, :email, :cpf, :telefone)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':cpf', $cpf);
            $sql->bindValue(':telefone', $telefone);
        $sql->execute();

    }

    public function edit($nome, $email, $cpf, $telefone, $id){

        $sql = $this->pdo->prepare("UPDATE cliente SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':telefone', $telefone);
        $sql->execute();

    }

    public function delete($id){

        $sql = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }

}
<?php

class Emprestimo {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAll(){

        $sql = $this->pdo->query("SELECT * FROM emprestimo");
        
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM emprestimo WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function novo($idLivro, $idCliente, $data) {

        $sql = $this->pdo->prepare("INSERT INTO emprestimo (id_livro, id_cliente, data_emprestimo) VALUES (:idLivro, :idCliente, :data)");
        $sql->bindValue(':idLivro', $idLivro);
        $sql->bindValue(':idCliente', $idCliente);
        $sql->bindValue(':data', $data);
        $sql->execute();
    
    }

    public function editarEmprestimo($idEmprestimo, $idLivro, $idCliente, $data) {

        $sql = $this->pdo->prepare("UPDATE emprestimo SET id_livro = :idLivro, id_cliente = :idCliente, data_emprestimo = :data WHERE id = :idEmprestimo");
        $sql->bindValue(':idEmprestimo', $idEmprestimo);
        $sql->bindValue(':idLivro', $idLivro);
        $sql->bindValue(':idCliente', $idCliente);
        $sql->bindValue(':data', $data);
        $sql->execute();
    
    }
    

}
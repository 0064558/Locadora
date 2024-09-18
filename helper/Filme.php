<?php

class Filme {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAll(){

        $sql = $this->pdo->query("SELECT * FROM filmes");
        
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function novo($nome, $tipo, $autor, $ano){

        $sql = $this->pdo->prepare("INSERT INTO filmes (nome, tipo, autor, ano) VALUES (:nome, :tipo, :autor, :ano)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':tipo', $tipo);
            $sql->bindValue(':autor', $autor);
            $sql->bindValue(':ano', $ano);
        $sql->execute();

    }

    public function edit($id, $nome, $tipo, $autor, $ano) {

        $sql = $this->pdo->prepare("UPDATE filmes SET nome = :nome, tipo = :tipo, autor = :autor, ano = :ano WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':autor', $autor);
        $sql->bindValue(':ano', $ano);
        $sql->execute();
        
    }

    public function delete($id){

        $sql = $this->pdo->prepare("DELETE FROM filmes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }

}
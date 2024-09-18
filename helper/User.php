<?php

class User {
    
    private $pdo;
    private $base;

    public function __construct($pdo, $base){
        $this->pdo = $pdo;
        $this->base = $base;
    }

    public function getUserData(){

        $sql = $this->pdo->query("SELECT * FROM usuario");
    
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public function register($name, $email, $pass){

        $token = md5(time().rand(0, 9999));

        $sql = $this->pdo->prepare("INSERT INTO usuario (nome, email, senha, token, acesso) VALUES (:nome, :email, :senha, :token, :acesso) ");
            $sql->bindValue(':nome', $name);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', $pass);
            $sql->bindValue(':token', $token);
            $sql->bindValue(':acesso', 1);
        $sql->execute();
        
        return $token;
    }

    public function verificarLogin($email, $pass){
        
        $sql = $this->pdo->prepare('SELECT * FROM usuario WHERE email = :email AND senha = :senha');
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $pass);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data['token'];
        }else{
            $_SESSION['flash'] = 'Email e/ou senha incorreto(s).';
        }

    }

    public function emailExists($email){

        $sql = $this->pdo->prepare('SELECT * FROM usuario WHERE email = :email');
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0)
            return true;
        else
            return false;

    }

    public function delete($id){

        $sql = $this->pdo->prepare("DELETE FROM usuario WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }

    public function edit($nome, $email, $acesso, $id){

        $sql = $this->pdo->prepare("UPDATE usuario SET nome = :nome, email = :email, acesso = :acesso WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':acesso', $acesso);
        $sql->execute();

    }

}
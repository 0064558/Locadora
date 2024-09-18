<?php

class Helper {
    
    private $pdo;
    private $base;

    public function __construct($pdo, $base){
        $this->pdo = $pdo;
        $this->base = $base;
    }

    public function checkToken($token){

        $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE token = :token");
        $sql->bindValue(':token', $token);
        $sql->execute();

        if($sql->rowCount() > 0){

            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;

        }else{

            //$_SESSION['token'] = '';
            header('location: '.$this->base.'/login.php');
            exit;

        }

    }

}
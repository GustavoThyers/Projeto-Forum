<?php
require_once ROOT_DIR . '/config.php'; // Usa a constante ROOT_DIR para incluir o arquivo config.php

require_once ROOT_DIR . '/models/Post.php'; // Usa a constante ROOT_DIR para incluir o arquivo Post.php


class PostDaoMySql implements PerguntaDao{
    private $pdo;

    //crio o pdo
    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Pergunta $p){
        $sql = $this->pdo->prepare('INSERT INTO perguntas (pergunta, corpo, data_hora, id_user) VALUES (:pergunta, :corpo, NOW(), :id)');
        $sql->bindValue(':pergunta', $p->getPergunta());
        $sql->bindValue(':corpo', $p->getCorpo());
        $sql->bindValue(':id', $p->getIdUser());

        $sql->execute();
    }

   

    public function list(){
        $sql = $this->pdo->prepare('SELECT * FROM perguntas');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
    public function listUser(){
        $sql = $this->pdo->prepare('SELECT * FROM users');
        $sql->execute();
    
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    
    }

    public function listPer($id){
        $sql = $this->pdo->prepare('SELECT * FROM perguntas WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function findByIdUser($id){
        $sql = $this->pdo->prepare('SELECT * FROM perguntas WHERE id_user = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function delete($id){
        $sql = $this->pdo->prepare('DELETE  FROM perguntas WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function pesquisa($p){
        $sql = $this->pdo->prepare('SELECT * FROM perguntas WHERE pergunta LIKE :query ');
        $sql->bindValue(':query', '%'.$p.'%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }


}

?>
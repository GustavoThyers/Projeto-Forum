<?php
require_once ROOT_DIR . '/config.php'; // Usa a constante ROOT_DIR para incluir o arquivo config.php

require_once ROOT_DIR . '/models/Respostas.php'; // Usa a constante ROOT_DIR para incluir o arquivo Post.php


class RespostaDaoMySql implements RespostaDao{
    private $pdo;

    //crio o pdo
    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Resposta $r){
        $sql = $this->pdo->prepare('INSERT INTO respostas (resposta, id_perguntas) VALUES (:resposta, :id)');
        $sql->bindValue(':resposta', $r->getResposta());
        $sql->bindValue(':id', $r->getId());

        $sql->execute();

        
    }

    public function list($id){
        $sql = $this->pdo->prepare('SELECT * FROM respostas WHERE id_perguntas = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

    }


    public function delete($id){
        $sql = $this->pdo->prepare('DELETE FROM respostas WHERE id_perguntas = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
}
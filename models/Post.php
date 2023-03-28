<?php

class Pergunta{
    public $id;
    public $pergunta;
    public $corpo;
    public $data_hora;
    public $id_user;

    public function setPergunta($p){
        $this->pergunta = $p;
    }

    public function getPergunta(){
        return $this->pergunta;
    }

    public function setCorpo($c){
        $this->corpo = $c;
    }

    public function getCorpo(){
        return $this->corpo;
    }

    public function setData($d){
        $this->data_hora = $d;
    }

    public function getData(){
        return $this->data_hora;
    }

    public function setIdUser($id){
        $this->id_user = $id;
    }

    public function getIdUser(){
        return $this->id_user;
    }

}

interface PerguntaDao{
    public function add(Pergunta $p);
}

?>
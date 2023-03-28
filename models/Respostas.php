<?php
class Resposta{
    
    public $resposta;
    public $id_pergunta;
    
    public function setId($i){
        $this->id_pergunta = $i;
    }

    public function getId(){
        return $this->id_pergunta;
    }

    public function setResposta($r){
        $this->resposta = $r;
    }

    public function getResposta(){
        return $this->resposta;
    }

    
}

interface RespostaDao{
    public function add(Resposta $r);
}


?>
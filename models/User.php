<?php



class User{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $apelido;
    public $admin;


    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setEmail($e){
        $this->email = $e;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setSenha($s){
        $this->senha = $s;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setApelido($a){
        $this->apelido = $a;
    }

    public function getApelido(){
        return $this->apelido;
    }

    public function setAdmin($a){
        $this->admin = $a;
    }

    public function getAdmin(){
        return $this->admin;
    }
}

interface UserDao{
    public function findByEmail($email);
    public function add(User $u);
}
<?php
require_once ROOT_DIR . '/config.php'; // Usa a constante ROOT_DIR para incluir o arquivo config.php

require_once ROOT_DIR . '/models/User.php'; // Usa a constante ROOT_DIR para incluir o arquivo Post.php

class UserDaoMySql implements UserDao{
    private $pdo;

    //crio o pdo
    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }
    private function generateUser($array) {
        $u = new User();
        $u->id = $array['id'] ?? 0;
        $u->email = $array['email'] ?? '';
        $u->senha = $array['senha'] ?? '';
        $u->nome = $array['nome'] ?? '';
       

        return $u;
}

public function findByEmail($email){
    $sql = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
    $sql->bindValue(':email',$email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        $user = $this->generateUser($data);
        return $user;
    }

    return false;
}

public function add(User $u){
    $hash = password_hash($u->senha, PASSWORD_DEFAULT);

    $sql = $this->pdo->prepare('INSERT INTO users (nome, email, senha, apelido) VALUES (:name, :email, :password, :apelido)');
    $sql->bindValue(':name', $u->getNome());
    $sql->bindValue(':email', $u->getEmail());
    $sql->bindValue(':password', $hash);
    $sql->bindValue(':apelido', $u->getApelido());

    $sql->execute();
}

public function validateLogin($email, $senha){
    $sql = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
    $sql->bindValue(':email',$email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if(password_verify($senha, $user['senha'])) {
            return $user;
        }
    }

    return false;
}

public function findByid($id){
    $sql = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
    $sql->bindValue(':id',$id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
      
        return $data;
    }

    return false;
}


}
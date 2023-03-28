<?php
require '../config.php';
require_once '../dao/UserDaoMySql.php';
require_once '../models/User.php';



$nome = filter_input(INPUT_POST,'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$apelido = filter_input(INPUT_POST, 'apelido');

$userDao = new UserDaoMySql($pdo);
$newUser = new User();

$resgatarEmail = $userDao->findByEmail($email);

if ($nome && $senha && $email && $apelido) {
    if ($resgatarEmail == false) {
        $newUser->setNome($nome);
        $newUser->setEmail($email);
        $newUser->setSenha($senha);
        $newUser->setApelido($apelido);

        $userDao->add($newUser);
        header('Location:login.php');

    }else{
        header('Location:registe.php');
        echo 'email Ja existe';
    }

}else{
    header('Location:register.php');
}
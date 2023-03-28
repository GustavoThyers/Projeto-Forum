<?php
require '../config.php';
require_once '../dao/UserDaoMySql.php';
require_once '../models/User.php';


$email = filter_input(INPUT_POST,'email');
$senha = filter_input(INPUT_POST,'senha');

$userDao = new UserDaoMySql($pdo);
$newUser = new User();
$auth = $userDao->validateLogin($email, $senha);


if ($email && $senha) {
    if ($auth) {
        $_SESSION['id'] = $auth['id'];
        $_SESSION['admin'] = $auth['admin'];

      
        if ($_SESSION['admin'] == 1) {
            header('Location:../dashboard.php');
            exit;
        }

       
        header('Location:../index.php');
        exit;
        
    }else{
        header('Location:login.php');
        echo 'Usuario ou senha incorretos';
    }
}else{
    header('Location:login.php');

    echo 'Preencha todos os campos';
}


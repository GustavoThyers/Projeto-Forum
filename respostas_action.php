<?php
require 'config.php';
require_once 'dao/PostDaoMySql.php';
require_once 'models/User.php';
require_once 'dao/RespostaDaoMySql.php';
require_once 'models/Respostas.php';
if (!isset($_SESSION['id'])) {
    // Se o usuário não tiver uma sessão válida, redirecione-o para a página de login ou exiba uma mensagem de erro
    header('Location:login/login.php');
    exit();
}
$respostaDao = new RespostaDaoMySql($pdo);

$daoPost = new PostDaoMySql($pdo);

$user = new Resposta();


$resposta = filter_input(INPUT_POST, 'resposta');

$id = filter_input(INPUT_POST,'id');


if ($id && $resposta) {
    $user->setId($id);
    $user->setResposta($resposta);

    $respostaDao->add($user);
    header('Location:index.php');
}




?>
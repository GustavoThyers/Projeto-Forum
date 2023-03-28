<?php
require '../config.php';
require_once '../dao/PostDaoMySql.php';
require_once '../models/Post.php';

if (!isset($_SESSION['id'])) {
    // Se o usuário não tiver uma sessão válida, redirecione-o para a página de login ou exiba uma mensagem de erro
    header('Location:login/login.php');
    exit();
}



$id = $_SESSION['id'];


$titulo = filter_input(INPUT_POST,'titulo');
$pergunta = filter_input(INPUT_POST,'pergunta');



$PostDao = new PostDaoMySql($pdo);

$List = $PostDao->listUser($id);


$NovaP = new Pergunta();


if ($pergunta && $titulo) {
    
    $NovaP->setPergunta($titulo);
    $NovaP->setCorpo($pergunta);
    $NovaP->setIdUser($id);

    $PostDao->add($NovaP);
    header('Location:../index.php');
    exit;

}else{
    header('Location:index.php');
}
?>
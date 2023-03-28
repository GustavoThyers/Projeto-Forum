<?php
require 'config.php';
require_once 'dao/PostDaoMySql.php';
require_once 'dao/UserDaoMySql.php';
require_once 'dao/RespostaDaoMySql.php';

if (!isset($_SESSION['id'])) {
    // Se o usuário não tiver uma sessão válida, redirecione-o para a página de login ou exiba uma mensagem de erro
    header('Location:login/login.php');
    exit();
}

$id = filter_input(INPUT_GET, 'id');
$resp = new RespostaDaoMySql($pdo);
$perg = new PostDaoMySql($pdo);


$list = $resp->list($id);


if ($id) {
    if (is_array($list)) {
        if (count($list) > 0 ) {
            $resp->delete($id);
        }
    } else {
        $perg->delete($id);
        header('Location: profile.php');
        exit;
    }
  
}else{
    header('Location:profile.php');
    exit;
}




?>
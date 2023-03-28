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

$daoPost = new PostDaoMySql($pdo);
$respostaDao = new RespostaDaoMySql($pdo);
$user = new UserDaoMySql($pdo);




$listas = $daoPost->list(); //listou todos os post


$pegarTodos = array(); // criando um array vazio para armazenar os usuários

// busca todos os usuários relacionados aos posts
foreach ($listas as $lista) {
    $id = $lista['id_user'];
    $pegar = $user->findByid($id)[0]; // extrai o usuário da subarray [0]
    $pegarTodos[$id] = $pegar;
}











?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>ShitForum</title>
</head>
<body>
<nav class="navbar bg-dark">
  <div class="container-fluid d-flex justify-content-between">
    <div class="sair">
        <a href="login/logout.php">Sair</a>
        <a href="profile.php"> <img src="profile_circle_icon_243655.svg" alt=""> </a>
    </div>
    <form class="d-flex  " role="search" action="pesquisa.php" method="get">
      <input class="form-control me-2 " type="search" name="p" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success "  type="submit">Search</button>
    </form>
  </div>
</nav>

<form action="actions/post_action.php" method="post">

    
    
    <div class="mb-3 ">
    
        <label style=" margin-top:20px" for="exampleFormControlTextarea1" class="form-label " > Seu titulo</label>  <br>
        <input name="titulo" type="text"> <br>
        <br>

        <label style=" margin-top:20px" for="exampleFormControlTextarea1" class="form-label ">O que desejas postar ?</label>
        <textarea class="form-control" name="pergunta" id="exampleFormControlTextarea1" rows="3"></textarea>
    
    </div>

    
    <div class="button">
        <button type="submit" class="btn btn-info">Publicar</button>
    </div>
</form>



<div class="title">
    <div class="alert alert-info" role="alert">
       <p class="text-center assunto"> Assuntos e Perguntas! </p>
    </div>
</div>





<div style="margin-bottom:50px;" class="cards-item">
    <?php foreach ($listas as $item2) : ?>
        <div style="width:300px;" class="card">
            <div class="card-header text-center">
                <?=$pegarTodos[$item2['id_user']]['nome'] ?> Vulgo <strong> <?=$pegarTodos[$item2['id_user']]['apelido']?></strong> Postou:
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?=$item2['pergunta'] ?></h5>
                <p class="card-text"><?=$item2['corpo']; ?></p>

                <?php 
                        $daoResposta = new RespostaDaoMySql($pdo);
                        $respostas = $daoResposta->list($item2['id']);
                        $count_respostas = isset($respostas) ? count($respostas) : 0;
                    ?>
                    <a href="resposta.php?id=<?=$item2['id'] ?>" class="btn btn-primary">Responder<span class="badge badge-light"><?= $count_respostas ?></span></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
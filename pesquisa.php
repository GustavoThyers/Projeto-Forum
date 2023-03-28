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




$pesquisa = filter_input(INPUT_GET,'p');




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



if ($pesquisa) {
    $posts = $daoPost->pesquisa($pesquisa);

}else{
    header('Location:index.php');
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
    <title>Document</title>
</head>
<body>
<div style="margin-bottom:50px;" class="cards-item">
    <?php if ($posts == null) : ?>
    <h1>Sem resultados</h1>
    <?php else: ?>    
       

    <?php foreach ($posts as $item2) : ?>
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
<?php endif; ?>
    
</body>
</html>

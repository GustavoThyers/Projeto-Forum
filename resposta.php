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
$resposta = new RespostaDaoMySql($pdo);

$daoPost = new PostDaoMySql($pdo);

$user = new Resposta();

$id = filter_input(INPUT_GET, 'id');



    $ma = $resposta->list($id);
  


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>

    <form action="respostas_action.php" method="post">
        <input type="text" placeholder="Sua resposta aqui" name="resposta" id="">
        <input type="hidden" name="id" value="<?=$id?>">
        <button type="submit">Enviar</button>
    </form> <br> <br>
    <?php if ($ma === null) : ?>
        <p>Não há respostas correspondentes a este post.</p>
    <?php else : ?>
        <br>
        <br>
    
          
        <div class="alert alert-success" role="alert">
            <h1 style="color:black; text-align:center;">Respostas</h1>
    </div>
    
    <?php foreach ($ma as $item) : ?>
  
        <div class="card">
            <div class="card-header">
                Anonimo
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <p>Um Usuario respondeu </p>
                <footer class="blockquote-footer"><?=$item['resposta']?></footer>
                </blockquote>
            </div>
        </div>    

    <p> </p>
    <?php endforeach?>
    <?php endif?>
</body>
</html>
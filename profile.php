<?php
require 'config.php';
require_once 'dao/PostDaoMySql.php';
require_once 'dao/UserDaoMySql.php';
if (!isset($_SESSION['id'])) {
    // Se o usuário não tiver uma sessão válida, redirecione-o para a página de login ou exiba uma mensagem de erro
    header('Location:login/login.php');
    exit();
}

$id = $_SESSION['id'];

$UserPer = new PostDaoMySql($pdo);

$BuscaPergunta = $UserPer->findByIdUser($id);


$userDao = new UserDaoMySql($pdo);

$user = $userDao->findByid($id);




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
    <nav class="navbar bg-dark mb-5">
    <div class="container-fluid d-flex justify-content-between">
        <div class="sair">
            <a href="login/logout.php">Sair</a>
            <a href="profile.php"> <img src="profile_circle_icon_243655.svg" alt=""> </a>
        </div>
        <form class="d-flex  " role="search">
        <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success "  type="submit">Search</button>
        </form>
    </div>
    </nav> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>


    <div class="mt-5 alert alert-success" role="alert">
        <?php foreach ($user as $user) : ?>
        
        
        <h1 class="text-center text-dark">Perfil De <?= $user['nome'] ?></h1>



        <?php endforeach; ?>
    </div>
    <?php if ($BuscaPergunta == null) : ?>
        <h3>O usuario ainda nao fez um Post</h3>
    <?php else: ?>
    <div class="d-flex justify-content-center mt-5">
        <div class="w-25  alert alert-primary" role="alert">
            <h5 class="text-center text-dark">Suas Perguntas:</h5>
        </div>
    </div>
    
    <div style="margin-bottom:50px;" class="cards-item">    
    <?php foreach ($BuscaPergunta as $item) : ?>
        
        
           
        
        <div style="width:300px;" class="card">
            <div class="card-header text-center">
                <p>Sua Pergunta Foi:</p>
            </div>
            
            <div class="card-body">
                    <h5 class="card-title text-center"><?= $item['pergunta']?></h5>
                    <div class="d-flex justify-content-between">
                    <p class="card-text"><?= $item['corpo'] ?></p>
                    
                        <a href="remove.php?id=<?= $item['id'] ?>"><img src="delete_remove_trash_icon_245874.svg" alt=""></a>
                    </div>
            </div>
             
        </div>
        
        <?php endforeach ?> 
        
    </div>    
   
  <?php endif ?>

</div>
</body>
</html>
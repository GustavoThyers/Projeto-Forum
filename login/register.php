<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
    <title>Document</title>
</head>
<body>
<section class="vh-200 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Registre-se</h2>
              <p class="text-white-50 mb-5">Preencha TODOS os campos CORRETAMENTE</p>
            <form action="register_action.php" method="post">
              <div class="form-outline form-white mb-4">
                <input type="text" id="typeEmailX" name="nome" placeholder="Seu nome" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Nome</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" placeholder="Seu email" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" name="senha" placeholder="Sua Senha" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX">Senha</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="typeEmailX" placeholder="Seu Apelido" name="apelido" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Apelido</label>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!"></a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            </form>
            </div>

            <div>
              <p class="mb-0">Ja tens uma conta ? <a href="login.php" class="text-white-50 fw-bold">Faça login</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
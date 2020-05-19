<?php
include('../back/conexion.php');
include('../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
//$categorias = $acc->getCategorias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/alertify/alertify.css">
    <link rel="stylesheet" href="css/alertify/alertify.min.css">
    <script src="js/jquery3-4-1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/573e0c24be.js" crossorigin="anonymous"></script>
    <script src="js/alertify/alertify.js"></script>
    <script src="js/alertify/alertify.min.js"></script>
</head>
<body id="productoBody">
  <div class="modal-dialog text-center">
    <div class="col-sm-8 main-section">
      <div class="modal-content">
        <div class="col-12">
          <h2> WolfBurger<i class="fas fa-hamburger"></i></h2>
        </div>
        <form class="col-12" action="../back/acceso.php" method="post">
          <div class="form-group" id="user-group">
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de usuario">
          </div>
          <div class="form-group" id="password-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <button type="submit" class="btnLogin" name="buttonLogin"> <i class="fas fa-sign-in-alt"> </i> Ingresar </button>
          </div>
        </form>
      </div>
    </div>
  </div>


</body>
</html>

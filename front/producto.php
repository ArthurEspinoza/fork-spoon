<?php
include('../back/conexion.php');
include('../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$idP = $_GET['idP'];
$producto = $acc->getUnProducto($idP);
$ingredientes = $acc->getIngreFromProduct($idP);
$categorias = $acc->getCategorias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
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
    <nav class="navbar navbar-expand-lg">
        <h2>WolfBurger<i class="fas fa-hamburger"></i></h2>
        <a href="menu.php">Inicio</a>
        <a href="orden.php" class="derechoProducto">Ver Orden<i class="far fa-list-alt fa-lg"></i></a>
    </nav>
    <section class="info">
        <div class="row">
            <div class="col-lg-6 imgProduct">
                <img src="<?php echo $producto['img']?>">
            </div>
            <div class="col-lg-6 productText">
                <h3><?php echo $producto['nombre']?> - $<?php echo $producto['precio']?> MXN</h3>
                <p><?php echo $producto['descrip']?></p>
                <ul class="fa-ul">
                    <?php 
                        foreach ($ingredientes as $item) {
                            if ($item['idI']!=1) {
                                if($item['idI']!=2){
                                    echo '<li><span class="fa-li"><i class="fas fa-arrow-right"></i></span>'.$item['nombre'].'</li>';
                                }
                            }
                        }
                    ?>
                </ul>
                <!---<button class="btnO">Agregar a mi orden</button>-->

                <!-- Button trigger modal -->
                <button type="button" class="btnO" data-toggle="modal" data-target="#exampleModal">
                  Agregar a mi orden </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $producto['nombre']?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <label for="quantity">Cantidad:</label>
                        <input type="number" id="cantidad" size="5" name="quantity" min="1" max="10" step="1" value="1">
                        <br>
                        <label for="exampleFormControlTextarea1">Personalizar producto</label>
                        <textarea class="form-control" id="notas" rows="3"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btnO" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnO" onclick="addToOrden(<?php echo $idP?>, 1)">Aceptar</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
function addToOrden(idP, numM){
  var cantidad = document.getElementById('cantidad').value;
  var notas = document.getElementById('notas').value;
  
  /*console.log(cantidad + notas + idP + numM);
  if(notas == ''){
    console.log("Es nula");
  }*/
  var datos = {
    idP: idP,
    numM: numM,
    cantidad: cantidad,
    notas: notas
  }
  $.ajax({
    type: 'POST',
    url: '../back/controllerAjax.php',
    data: datos,
    success: function(res){
      console.log(res);
    }
  })
}
</script>
</html>

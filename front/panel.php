<?php
session_start(); 
include('../back/conexion.php');
include('../back/acciones.php');
$numT = $_SESSION['numT'];
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$top = $acc->topPlatillos();
$productos = $acc->getProductos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanelAdministrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/panel.css">
    <link rel="stylesheet" href="css/alertify/alertify.css">
    <link rel="stylesheet" href="css/alertify/alertify.min.css">
    <script src="js/jquery3-4-1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/573e0c24be.js" crossorigin="anonymous"></script>
    <script src="js/alertify/alertify.js"></script>
    <script src="js/alertify/alertify.min.js"></script>
</head>
<body>
    <div class="container">
        <div id="header">
            <h1>WolfBurger<i class="fas fa-hamburger"></i></h1>
            <a class="active" href="#">Platillos</a><a href="panelIngredientes.php">Ingredientes</a>
            <a href="../back/cerrar.php" class="cerrarS">Cerrar Sesión</a>
        </div>
        <div id="panel">
            <h2>Platillos más pedidos <i class="fas fa-star"></i></h2>
            <div class="row">
                <?php 
                    foreach ($top as $t) {
                        $imprime =  '<div class="col-md-4">';
                        $imprime .= '<h3>'.$t['nombre'].'</h3>
                                    <p>#Pedidos: <span class="spedidos">'.$t['contPedidos'].'</span></p>
                                    <p>Precio: <span class="sprecio">$'.$t['precio'].'</span></p>
                                    <img src="'.$t['img'].'" class="topImg"/></div>';
                        echo $imprime;
                    }
                ?>
            </div>
            <h2 id="tp">Todos los platillos</h2>
            <button class="btn btnAdd" onclick="location.href='platillo/add.php'">Agregar platillo</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>#Pedidos</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($productos as $p) {
                            $fila = '<tr>
                                <td>'.$p['idP'].'</td>
                                <td>'.$p['nombre'].'</td>
                                <td>'.$p['categoria'].'</td>
                                <td>'.$p['precio'].'</td>
                                <td>'.$p['contPedidos'].'</td>
                                <td>
                                    <button class="btn btn-info" 
                                            onclick="location.href=\'platillo/update.php?idP='.$p['idP'].'\'">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger"
                                            onclick="eliminar('.$p['idP'].')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>';
                            echo $fila;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    function eliminar(idP){
        var datos = {
            platillo: idP
        }
        console.log(datos);
        $.ajax({
            type: 'POST',
            url: '../back/funcionesAjaxAdmin.php',
            data: datos,
            success: function(res){
                console.log(res);
                if(res == "1"){
                    alert("Platillo Eliminado");
                    window.location.href="panel.php";
                }
            }
        })
    }
</script>
</html>
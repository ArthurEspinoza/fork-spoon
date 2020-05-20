<?php 
session_start(); 
include('../back/conexion.php');
include('../back/acciones.php');
$numT = $_SESSION['numT'];
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$ingrediente = $acc->getIngredientes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredientes</title>
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
            <a href="panel.php">Platillos</a><a class="active" href="panelIngredientes.php">Ingredientes</a>
            <a href="../back/cerrar.php" class="cerrarS">Cerrar Sesión</a>
        </div>
        <div id="ingrePanel">
            <h2>Todos los ingredientes</h2>
            <button class="btn btnAdd" onclick="location.href='ingre/add.php'">Agregar ingrediente</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Presentación</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($ingrediente as $i) {
                            $s = 
                            '<tr>
                                <td>'.$i['idI'].'</td>
                                <td>'.$i['nombre'].'</td>
                                <td>'.$i['precio'].'</td>
                                <td>'.$i['stock'].'</td>
                                <td>'.$i['tipoStock'].'</td>
                                <td>
                                    <button class="btn btn-warning" onclick="addStock('.$i['idI'].', '.$i['stock'].')">+ Stock</button>
                                    <button class="btn btn-info" 
                                            onclick="location.href=\'ingre/update.php?id='.$i['idI'].'\'">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger"
                                            onclick="eliminar('.$i['idI'].')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </td>';
                            echo $s;
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
function addStock(idI, stock){
    var s = stock + 1;
    var datos = {
        idS: idI,
        stock: s
    }
    console.log(datos);
    $.ajax({
        type: 'POST',
        url: '../back/funcionesAjaxAdmin.php',
        data: datos,
        success: function(res){
            console.log(res);
            if(res == "1"){
                alert("Stock aumentado");
                window.location.href="panelIngredientes.php";
            }
        }
    })
}
function eliminar(idI){
        var datos = {
            idI: idI
        }
        console.log(datos);
        $.ajax({
            type: 'POST',
            url: '../back/funcionesAjaxAdmin.php',
            data: datos,
            success: function(res){
                console.log(res);
                if(res == "11" || res == "21"){
                    alert("Platillo Eliminado");
                    window.location.href="panelIngredientes.php";
                }
            }
        })
    }
</script>
</html>
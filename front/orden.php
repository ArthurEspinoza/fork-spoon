<?php 
include('../back/conexion.php');
include('../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$ordenes = $acc->verOrden(1, 'Arturo Espinoza Quintero');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi orden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/orden.css">
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
        
    </nav>
    <section id="ordenBody">
        <h1>Orden para la mesa: 1</h1>
        <?php
            foreach ($ordenes as $orden) {
                $card = '<div class="card" style="width: 70%;">';
                $card .= '
                    <div class="card-body">
                        <h5>'.$orden['nombre'].'</h5>';
                if(isset($orden['notas'])){
                    $card .= '
                        <p>'.$orden['notas'].'<br></p></div>
                    ';
                }else{
                    $card .= '<p>No se hizo ninguna personalización para este platillo</p></div>';
                }
                $card .= '
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Cantidad:
                            <button id="menos" onclick="updateC(\'-\', '.$orden['idP'].','.$orden['numM'].',\''.$orden['cliente'].'\', '.$orden['cantidad'].')"><i class="fas fa-minus"></i></button>
                            '.$orden['cantidad'].'
                            <button id="mas" onclick="updateC(\'+\', '.$orden['idP'].','.$orden['numM'].',\''.$orden['cliente'].'\', '.$orden['cantidad'].')"><i class="fas fa-plus"></i></button> 
                        </li>
                        <li class="list-group-item">
                            Precio:<div id="precio">$'.$orden['precio'].' MXN</div>
                        </li>
                    </ul>
                ';
                $card .= '
                    <div class="card-body">
                        <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                ';
                $card .= '</div>';
                echo $card;
            }
        ?>
    </section>
</body>
<script>
    function updateC(tipo, idP, numM, cliente, cantidad){
        //console.log(tipo+idP+idM+cliente);
        var datos = {
            op: tipo,
            idP: idP,
            numM: numM,
            cliente: cliente,
            cantidad: cantidad            
        }
        $.ajax({
            type: 'POST',
            url: '../back/controllerAjax.php',
            data: datos,
            success: function(res){
                //console.log(res);
                window.location.href="orden.php"
            }
        })
    }
</script>
</html>
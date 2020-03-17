<?php 
include('../back/conexion.php');
include('../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$categorias = $acc->getCategorias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
<body>
    <nav class="navbar navbar-expand-lg">
        <h2>WolfBurger<i class="fas fa-hamburger"></i></h2>
        <a href="menu.php">Inicio</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias</a>
            <div class="dropdown-menu">
                <?php 
                    foreach ($categorias as $fila) {
                        echo '<a href="#" class="dropdown-item">'.$fila['categoria'].'</a>';
                    }
                ?>
            </div>
        </div>
        <a href="#" class="derecho">Ver Orden<i class="far fa-list-alt fa-lg"></i></a>
    </nav>
    <section id="cover">
        <img src="assets/fondo.jpg" alt="">
        <div id="text">
            <h2>¡A que no <br> puedes con solo <br> UNA!</h2>
        </div>
    </section>
    <section id="productos">
        <h1>Platillos</h1><hr>
        <!--<div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>-->
        <div class="card-columns">
        <?php 
            $productos = $acc->getProductos();
            foreach ($productos as $fila) {
                $tarjeta = '<div class="card">';
                $tarjeta .= '
                    <img src="'.$fila['img'].'" class="img-card-top">
                    <div class="card-body">
                        <h4 class="card-title"><a href="producto.php?idP='.$fila['idP'].'">'.$fila['nombre'].'</a></h4>
                        <p class="card-text">'.$fila['descrip'].'</p>
                ';
                $tarjeta.='
                    </div>
                    </div>';
                echo $tarjeta;
            }
        ?>
        
        </div>
    </section>
</nav>
</body>
</html>
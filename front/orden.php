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
        <!-- <div class="card-deck">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nombre del platillo</h5>
                    <p class="card-text">No se hizo ninguna personalización para este platillo<br> </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cantidad: </li>
                    <li class="list-group-item">Precio:</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Nombre del platillo</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cantidad: </li>
                    <li class="list-group-item">Precio:</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Nombre del platillo</h5>
                        <p class="card-text">No se hizo ninguna personalización para este platillo<br> </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cantidad: 
                            <button id="menos"><i class="fas fa-minus"></i></button>
                                50
                            <button id="mas" ><span><i class="fas fa-plus"></i></span></button> </li>
                        <li class="list-group-item">Precio: $1000 MXN</li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Nombre del platillo</h5>
                        <p class="card-text">No se hizo ninguna personalización para este platillo<br> </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cantidad:
                            <button id="menos"><i class="fas fa-minus"></i></button>
                                50
                            <button id="mas" ><span><i class="fas fa-plus"></i></span></button> </li>
                        <li class="list-group-item">Precio: $1000 MXN</li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Nombre del platillo</h5>
                        <p class="card-text">No se hizo ninguna personalización para este platillo<br> </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cantidad: 
                            <button id="menos"><i class="fas fa-minus"></i></button>
                                50
                            <button id="mas" ><span><i class="fas fa-plus"></i></span></button></li>
                        <li class="list-group-item">Precio: $1000 MXN</li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Nombre del platillo</h5>
                        <p class="card-text">No se hizo ninguna personalización para este platillo<br> </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cantidad: 
                            <button id="menos"><i class="fas fa-minus"></i></button>
                                50
                            <button id="mas" ><span><i class="fas fa-plus"></i></span></button></li>
                        <li class="list-group-item">Precio: $1000 MXN</li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
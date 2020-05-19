<?php 
session_start();
include('../../back/conexion.php');
include('../../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$ingrediente = $acc->getIngredientes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddPlatillo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/alertify/alertify.css">
    <link rel="stylesheet" href="../css/alertify/alertify.min.css">
    <script src="../js/jquery3-4-1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/573e0c24be.js" crossorigin="anonymous"></script>
    <script src="../js/alertify/alertify.js"></script>
    <script src="../js/alertify/alertify.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="formContainer">
            <h2>Ingresa la información del platillo a crear</h2>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="categoria">Categoria</label>
                        <input type="text" name="cate" id="cate" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descrip">Descripción</label>
                    <textarea class="form-control" name="descrip" id="descrip" 
                            cols="30" rows="10" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio" id="precio" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="img">Imagen</label>
                        <input type="file" name="img" id="img" class="form-control-file">
                    </div>
                </div>
            </form>
            <h2>Seleccione los ingredientes del platillo</h2>
            <form>
                <div class="form-row">
                <?php 
                    $t1; $t2;
                    $i = 0;
                    $tam = sizeof($ingrediente);
                    if($tam > 10){
                        if($tam%2 == 0){
                            $t1 = $tam/2;
                            $t2 = $tam/2;
                        }else{
                            $t1 = ($tam+1)/2;
                            $t2 = ($tam-1)/2;
                        }
                        $p1 = '<div class="form-group form-check col-md-6">';
                        while($i < $t1){
                            $p1 .= '
                                <input type="checkbox" name="ingredientes" id="'.$ingrediente[$i]['idI'].'">
                                <label for="nombreI" class="form-check-label">'.$ingrediente[$i]['nombre'].'</label><br>
                            ';
                            $i++; 
                        }
                        $p1 .= '</div>';
                        $j=0;
                        $p2 = '<div class="form-group form-check col-md-6">';
                        while($j < $t2){
                            $p2 .= '
                                <input type="checkbox" name="ingredientes" id="'.$ingrediente[$i+$j]['idI'].'">
                                <label for="nombreI" class="form-check-label">'.$ingrediente[$i+$j]['nombre'].'</label><br>
                            ';
                            $j++; 
                        }
                        $p2 .= '</div>';
                        echo $p1;
                        echo $p2; 
                    }
                ?>
                </div>
            </form>
            <button class="btnAdd" onclick="getInputs()">Añadir Platillo</button>     
        </div>
    </div>
</body>
</html>
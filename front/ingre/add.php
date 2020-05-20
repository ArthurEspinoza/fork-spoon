<?php 
include('../../back/conexion.php');
include('../../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$tipos = $acc->getTiposStock();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddIngre</title>
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
            <h2>Ingresa la información del ingrediente a agregar</h2>
            <form>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stock">¿Cuantos elementos vas a agregar?</label>
                        <input type="number" name="stock" id="stock" min="1" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipo">Presentación</label>
                        <select name="tipos" id="tipos" class="custom-select">
                            <option selected>Elige uno...</option>
                            <?php 
                                foreach ($tipos as $t) {
                                    echo '<option value="'.$t['tipoStock'].'">'.$t['tipoStock'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
            <button class="btn btnAdd" onclick="agregar()">Agregar ingrediente</button>
        </div>
    </div>
</body>
<script>
    function agregar(){
        var n = document.getElementById('nombre').value;
        var p = document.getElementById('precio').value;
        var s = document.getElementById('stock').value;
        var t = document.getElementById('tipos').value;
        //console.log(n+p+s+t);
        var datos = {
            ni: n,
            pi: p,
            si: s,
            ti: t
        }
        $.ajax({
            type: 'POST',
            url: '../../back/funcionesAjaxAdmin.php',
            data: datos,
            success: function(res){
                console.log(res);
                if(res == "1"){
                    alert('Ingrediente agregado exitosamente');
                    window.location.href = "../panelIngredientes.php";
                }
            }
        })
    }
</script>
</html>
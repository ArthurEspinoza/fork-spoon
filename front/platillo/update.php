<?php
include('../../back/conexion.php');
include('../../back/acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
$idP = $_GET['idP'];
$platillo = $acc->getUnProducto($idP);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpdatePlatillo</title>
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
                        <input type="text" name="nombre" id="nombre" class="form-control" 
                                value="<?php echo $platillo['nombre']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="categoria">Categoria</label>
                        <input type="text" name="cate" id="cate" class="form-control" 
                                value="<?php echo $platillo['categoria']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="descrip">Descripción</label>
                    <textarea class="form-control" name="descrip" id="descrip" 
                            cols="20" rows="10"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio" id="precio" class="form-control"
                                value="<?php echo $platillo['precio']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="img" id="imgLabel">Imagen</label>
                        <img src="../<?php echo $platillo['img']?>" alt="platillo" class="imgForm">
                        <input type="file" name="img" id="foto" class="form-control-file">
                    </div>
                </div>
            </form>
            <button class="btnUpd" onclick="getInputs(<?php echo $idP?>)">Modificar Platillo</button>
        </div>
    </div>
</body>
<script>
    document.getElementById('descrip').value = "<?php echo $platillo['descrip']?>";
    function getInputs(idP){
        var n = document.getElementById('nombre').value;
        var c = document.getElementById('cate').value;
        var d = document.getElementById('descrip').value;
        var p = document.getElementById('precio').value;
        var f = document.getElementById('foto').value;
        if(f == ""){
            f = "<?php echo $platillo['img']?>";
        }else{
            var arr = f.split('\\');
            f = 'assets/'+arr[2];
        }
        // console.log(f);
        var datos = {
            id: idP,
            n: n,
            c: c,
            d: d,
            p: p,
            f: f
        }
        console.log(datos)
        $.ajax({
            type: 'POST',
            url: '../../back/funcionesAjaxAdmin.php',
            data: datos,
            success: function(res){
                console.log(res);
                if(res == "1"){
                    alert("Platillo Modificado exitosamente");
                    window.location.href="../panel.php";
                }
            }
        })
    }
</script>
</html>
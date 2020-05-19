<?php 
include('conexion.php');
include('acciones.php');
$conn = Singleton::getInstance();
$acc = new Menu($conn);
//Eliminar Platillo
if(isset($_POST['platillo'])){
    $idP = $_POST['platillo'];
    $result = $acc->deletePlatillo($idP);
    echo $result;
}
//agregar platillo
if(isset($_POST['id'])&&isset($_POST['n'])&&isset($_POST['c'])&&
   isset($_POST['d'])&&isset($_POST['p'])&&isset($_POST['f'])&&
   isset($_POST['ingre'])){
        $numT = $_POST['id'];
        $n = $_POST['n'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $p = $_POST['p'];
        $f = $_POST['f'];
        $ingre = $_POST['ingre'];
        $result = $acc->addPlatillo($numT, $n, $c, $d, $p, $f, $ingre);
        echo $result;
   }
//Modificar platillo
if(isset($_POST['id'])&&isset($_POST['n'])&&isset($_POST['c'])&&
   isset($_POST['d'])&&isset($_POST['p'])&&isset($_POST['f'])){
        $idP = $_POST['id'];
        $n = $_POST['n'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $p = $_POST['p'];
        $f = $_POST['f'];
        $result = $acc->updPlatillo($idP, $n, $c, $d, $p, $f);
        echo $result;
   }

?>
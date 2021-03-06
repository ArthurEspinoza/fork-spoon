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
//Agregar Ingrediente
if(isset($_POST['ni'])&&isset($_POST['pi'])&&isset($_POST['si'])&&isset($_POST['ti'])){
   $n = $_POST['ni'];
   $p = $_POST['pi'];
   $s = $_POST['si'];
   $t = $_POST['ti'];
   $result = $acc->addIngrediente($n, $p, $s, $t);
   echo $result;
}
//Modificar ingrediente
if(isset($_POST['idi'])&&isset($_POST['ni'])&&isset($_POST['pi'])&&isset($_POST['si'])&&isset($_POST['ti'])){
   $idI = $_POST['idi'];
   $n = $_POST['ni'];
   $p = $_POST['pi'];
   $s = $_POST['si'];
   $t = $_POST['ti'];
   $result = $acc->updIngrediente($idI, $n, $p, $s, $t);
   echo $result;
}
//Eliminar ingrediente
if(isset($_POST['idI'])){
   $idI = $_POST['idI'];
   $result = $acc->delIngrediente($idI);
   echo $result;
}
//Aumentar Stock
if(isset($_POST['idS'])&&isset($_POST['stock'])){
   $idI = $_POST['idS'];
   $s = $_POST['stock'];
   $result = $acc->stockUp($idI, $s);
   echo $result;
}
?>
<?php 
include('conexion.php');
$conn = Singleton::getInstance();
function updateC($conn, $idP, $idM, $cliente, $cantidad){
    $query = $conn->db->prepare('UPDATE orden inner join mesas on orden.numM = mesas.numM 
                         set cantidad = :c where orden.idp = :idP and cliente = :client and orden.numM = :nM');
    $query->bindParam(':c', $cantidad, PDO::PARAM_INT);
    $query->bindParam(':idP', $idP, PDO::PARAM_INT);
    $query->bindParam(':client', $cliente, PDO::PARAM_STR);
    $query->bindParam(':nM', $idM, PDO::PARAM_INT);
    if($query->execute()){
        echo 1;
    }else {
        echo 0;
    }
}
function borrarE($conn, $idP, $numM, $cliente){
    $query = $conn->db->prepare('DELETE orden from orden inner join mesas on orden.numM = mesas.numM 
                                 where orden.idP = :idP and cliente = :c and orden.numM = :nM;');
    $query->bindParam(':idP', $idP, PDO::PARAM_INT);
    $query->bindParam(':c', $cliente, PDO::PARAM_STR);
    $query->bindParam(':nM', $numM, PDO::PARAM_INT);
    if($query->execute()){
        echo 1;
    }else{
        echo 0;
    }
}
function addE($conn, $idP, $numM, $cantidad, $notas){
    if($notas == ''){
        $query = $conn->db->prepare('INSERT into orden(idP, numM, cantidad) values(:id, :nM, :c)');
        $query->bindParam(':id', $idP, PDO::PARAM_INT);
        $query->bindParam(':nM', $numM, PDO::PARAM_INT);
        $query->bindParam(':c', $cantidad, PDO::PARAM_INT);
        if($query->execute()){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        $query = $conn->db->prepare('INSERT into orden(idP, numM, cantidad, notas) values(:id, :nM, :c, :n)');
        $query->bindParam(':id', $idP, PDO::PARAM_INT);
        $query->bindParam(':nM', $numM, PDO::PARAM_INT);
        $query->bindParam(':c', $cantidad, PDO::PARAM_INT);
        $query->bindParam(':n', $notas, PDO::PARAM_STR);
        if($query->execute()){
            echo 1;
        }else{
            echo 0;
        }
    }
}
// Invocacion de las funciones
if(isset($_POST['op'])&&isset($_POST['idP'])&&isset($_POST['numM'])&&
   isset($_POST['cliente'])&&isset($_POST['cantidad'])){
       $op = $_POST['op'];
       $idP = $_POST['idP'];
       $numM = $_POST['numM'];
       $cliente = $_POST['cliente'];
       $cantidad = $_POST['cantidad'];
        // echo $op.$idP.$numM.$cliente.$cantidad;
        switch ($op) {
            case '+':
                $cantidad += 1;
                updateC($conn, $idP, $numM, $cliente, $cantidad);
                break;
            case '-':
                $cantidad -= 1;
                updateC($conn, $idP, $numM, $cliente, $cantidad);
                break;
        }
   }
if(isset($_POST['idP'])&&isset($_POST['numM'])&&isset($_POST['cliente'])){
    $idP = $_POST['idP'];
    $numM = $_POST['numM'];
    $cliente = $_POST['cliente'];
    // echo $idP.$numM.$cliente;
    borrarE($conn, $idP, $numM, $cliente);
}
if(isset($_POST['idP'])&&isset($_POST['numM'])&&isset($_POST['cantidad'])&&
    isset($_POST['notas'])){
        $idP = $_POST['idP'];
        $numM = $_POST['numM'];
        $cantidad = $_POST['cantidad'];
        $notas = $_POST['notas'];
        addE($conn, $idP, $numM, $cantidad, $notas);
    }
?>
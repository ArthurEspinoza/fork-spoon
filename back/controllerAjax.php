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
        if(cambiarContador($conn, $idP, '-') == 1){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
}
function cambiarContador($conn, $idP, $opc){
    $getContador = $conn->db->prepare('SELECT contPedidos from productos WHERE idP = :i');
    $getContador->bindParam(':i', $idP, PDO::PARAM_INT);
    if($getContador->execute()){
        $resultado = $getContador->fetch();
        if($opc == '+'){
            $nc = $resultado['contPedidos'] + 1;
            $actCantidad = $conn->db->prepare('UPDATE productos set contPedidos=:c where idP = :i');
            $actCantidad->bindParam(':c', $nc, PDO::PARAM_INT);
            $actCantidad->bindParam(':i', $idP, PDO::PARAM_INT);
            if($actCantidad->execute()){
                return 1;
            }else{
                return 0;
            }
        }else{
            if($resultado['contPedidos'] != 0){
                $nc = $resultado['contPedidos'] - 1;
                $actCantidad = $conn->db->prepare('UPDATE productos set contPedidos=:c where idP = :i');
                $actCantidad->bindParam(':c', $nc, PDO::PARAM_INT);
                $actCantidad->bindParam(':i', $idP, PDO::PARAM_INT);
                if($actCantidad->execute()){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
    }
    
}
function addE($conn, $idP, $numM, $cantidad, $notas){
    //Verificamos si el producto está en la orden
    $verificar = $conn->db->prepare('SELECT * FROM orden WHERE idP=:i AND numM=:m');
    $verificar->bindParam(':i', $idP, PDO::PARAM_INT);
    $verificar->bindParam(':m', $numM, PDO::PARAM_INT);
    if($verificar->execute()){
        $veriResult = $verificar->fetch(); //Resultados de Verificar
        if(!($verificar->rowCount()>0)){
            if($notas == ''){
                $query = $conn->db->prepare('INSERT into orden(idP, numM, cantidad) values(:id, :nM, :c)');
                $query->bindParam(':id', $idP, PDO::PARAM_INT);
                $query->bindParam(':nM', $numM, PDO::PARAM_INT);
                $query->bindParam(':c', $cantidad, PDO::PARAM_INT);
                if($query->execute()){
                    if(cambiarContador($conn, $idP, '+') == 1){
                        echo 111;
                    }else{
                        echo 011;
                    }
                }else{
                    echo 01;
                }
            }else{
                $query = $conn->db->prepare('INSERT into orden(idP, numM, cantidad, notas) values(:id, :nM, :c, :n)');
                $query->bindParam(':id', $idP, PDO::PARAM_INT);
                $query->bindParam(':nM', $numM, PDO::PARAM_INT);
                $query->bindParam(':c', $cantidad, PDO::PARAM_INT);
                $query->bindParam(':n', $notas, PDO::PARAM_STR);
                if($query->execute()){
                    if(cambiarContador($conn, $idP, '+') == 1){
                        echo 111;
                    }else{
                        echo 011;
                    }
                }else{
                    echo 01;
                }
            }
        }else{
            //var_dump($veriResult);
            $nc = $veriResult['cantidad'] + 1;
            $queryC = $conn->db->prepare('UPDATE orden set cantidad = :c where orden.idp = :i and orden.numM = :n');
            $queryC->bindParam(':c', $nc, PDO::PARAM_INT);
            $queryC->bindParam(':i', $idP, PDO::PARAM_INT);
            $queryC->bindParam(':n', $numM, PDO::PARAM_INT);
            if($queryC->execute()){
                echo 10 . $nc;
            }else{
                echo 00;
            }
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
        // cambiarContador($conn, $idP, '+');
        addE($conn, $idP, $numM, $cantidad, $notas);
    }
?>
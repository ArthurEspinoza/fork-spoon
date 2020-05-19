<?php 
include('conexion.php');
$conn = Singleton::getInstance();
$u = $_POST['usuario'];
$p = $_POST['password'];
$query = $conn->db->prepare("SELECT numT from usuarios where username=:u and passwd=:p ");
$query->bindParam(':u', $u, PDO::PARAM_STR);
$query->bindParam(':p', $p, PDO::PARAM_STR);
if($query->execute()){
    $resultado = $query->fetch();
    if(isset($resultado['numT'])&&$resultado['numT']!=null){
        session_start();
        $_SESSION['numT']=$resultado['numT'];
        header('Location: ../front/panel.php');
    }
}
?>
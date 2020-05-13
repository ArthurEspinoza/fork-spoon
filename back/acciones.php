<?php 
   //include('conexion.php');
   //$conn = Singleton::getInstance();
   class Menu
   { 
      public $conn;
      function __construct($conexion){
         $this->conn = $conexion;
      }
      //Funciones para los menús 
      function getProductos(){
         $resultado;
         $query = $this->conn->db->prepare('SELECT * FROM productos');
         if ($query->execute()) {
            $resultado = $query->fetchAll();
            return $resultado;
         }
      }
      function getUnProducto($idP){
         $resultado;
         $query = $this->conn->db->prepare('SELECT * FROM productos WHERE idp=:i');
         $query->bindParam(':i',$idP,PDO::PARAM_INT);
         if ($query->execute()) {
            $resultado = $query->fetch();
            return $resultado;
         }
      }
      function getCategorias(){
         $resultado;
         $query = $this->conn->db->prepare('SELECT categoria FROM productos GROUP BY categoria');
         if ($query->execute()) {
            $resultado = $query->fetchAll();
            return $resultado;
         }
      }
      function getIngreFromProduct($idP){
         $resultado;
         $query = $this->conn->db->prepare('SELECT i.nombre as nombre, i.idI as idI FROM incluyen AS inc
                                            inner join ingredientes as i on inc.idI = i.idI
                                            Where inc.idP=:id ORDER BY idI ASC');
         $query->bindParam(':id',$idP, PDO::PARAM_INT);
         if ($query->execute()) {
            $resultado = $query->fetchAll();
            return $resultado;
         }
      }
      //Funciones de administrador
      function insertarIngredientes($nombre, $precio, $stock){
         $query = $this->conn->db->prepare('INSERT INTO ingredientes(nombre,precio,stock)VALUES(:n, :p, :s)');
         $query->bindParam(':n', $nombre, PDO::PARAM_STR);
         $query->bindValue(':p', $precio);
         $query->bindParam(':s', $stock, PDO::PARAM_INT);
         if($query->execute()){
            return "INSERT-OK";
         }
       }
       function insertarProducto($numT, $nombre, $precio, $categoria, $descrip, $img){
          $query = $this->conn->db->prepare('INSERT INTO productos(numT,nombre,precio,categoria,descrip,img)
                                                         VALUES(:nT,:n,:p,:c,:d,:i)');
          $query->bindParam(':nT',$numT,PDO::PARAM_INT);
          $query->bindParam(':n',$nombre,PDO::PARAM_STR);
          $query->bindValue(':p',$precio);
          $query->bindParam(':c',$categoria,PDO::PARAM_STR);
          $query->bindParam(':d',$descrip,PDO::PARAM_STR);
          $query->bindParam(':i',$img,PDO::PARAM_STR);
          if($query->execute()){
             return "INSERT-OK";
          }
       }
       function actualizarProducto($idP,$nombre,$precio,$categoria,$descrip,$img){
          $query = $this->conn->db->prepare('UPDATE productos set nombre=:n,precio=:p,categoria=:c,descrip=:d,img=:i
                                                              WHERE idP=:id');
         $query->bindValue(':n',$nombre);
         $query->bindValue(':p',$precio);
         $query->bindValue(':c',$categoria);
         $query->bindValue(':d',$descrip);
         $query->bindValue(':i',$img);
         $query->bindValue(':id',$idP);
         if($query->execute()){
            return "UPDATE-OK";
         }
       }
       function borrarProducto($idP){
          $query = $this->conn->db->prepare('DELETE FROM productos WHERE idP=:id');
          $query->bindParam(':id',$idP,PDO::PARAM_INT);
          if($query->execute()){
             return "DELETE-OK";
          }
       }
       function topPlatillos(){
          $resultado;
          $query = $this->conn->db->prepare('SELECT contPedidos, nombre, precio, img from productos 
                                                    where categoria="Hamburguesas" order by contPedidos desc limit 3');
          if($query->execute()){
            $resultado = $query->fetchAll();
            return $resultado;
          }
       }
       //Funciones de orden
       function verOrden($numM, $cl){
          $resultado;
          $query = $this->conn->db->prepare('SELECT p.nombre, p.precio, o.notas, o.cantidad, m.numM, p.idP, m.cliente from orden as o
                                                    inner join productos as p on o.idP = p.idP
                                                    inner join mesas as m on o.numM = m.numM
                                                    where m.numM = :nm and m.cliente = :c');
         $query->bindParam(':nm', $numM, PDO::PARAM_INT);
         $query->bindParam(':c', $cl, PDO::PARAM_STR);
         if($query->execute()){
            $resultado = $query->fetchAll();
            return $resultado;
         }
       }
   }
   //$m = new Menu($conn);
   //VER PRODUCTOS
   /*$r = $m->getProductos();
   foreach ($r as $fila) {
      echo $fila['nombre'].' --- '.$fila['precio'].'<br>';
   }*/
   //VER UN PRODUCTO
   /*$r = $m->getUnProducto(1);
   echo $r['nombre'].' --- '.$r['precio'].'<br>';*/
   //INSERTAR INGREDIENTE
   /*$r = $m->insertarIngredientes('Tomate', 34.5, 3);
   echo $r;*/
   //INSERTAR ALIMENTO
   /*$r = $m->insertarProducto(12345,'Ensalada Sencilla',60.5,'Entradas','Ensalada con lechuga, jitomate, limon y un poco de sal','assets/ensalada.jpg');
   echo $r;*/
   //ACTUALIZAR PRODUCTO
   /*$r = $m->actualizarProducto(3,'Ensalada Sencilla',60.7,'Entradas','Ensalada con lechuga, jitomate, limon y un poco de sal','assets/ensalada.jpg');
   echo $r;*/

?>
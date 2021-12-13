<?php
include '../Config/conexiones_BD.php';
function cargar_post(){
    try {
        $base = conectar("admin"); 
        $sql = $base->prepare("SELECT * FROM posts ORDER BY id_post DESC LIMIT 5");
        $sql->execute();
        $resultados = $sql->fetchAll();
        return $resultados;
         $sql = null;
        $base = null;
} catch (PDOException $e) {
    print $e->getMessage();
}
}
function cargar_todos_post(){
    try {
        $base = conectar("admin"); 
        $sql = $base->prepare("SELECT * FROM posts ORDER BY id_post DESC ");
        $sql->execute();
        $resultados = $sql->fetchAll();
        return $resultados;
         $sql = null;
        $base = null;
} catch (PDOException $e) {
    print $e->getMessage();
}
}
function borrar_post($id){
    try {
        $base = conectar('admin');
           $sentencia = $base->prepare("DELETE FROM posts WHERE id_post=:id_post");
           $sentencia->bindParam(':id_post', $id);
           $sentencia->execute();
       $sentencia = null;
       $base = null;
   } catch (PDOException $e) {
       print $e->getMessage();
   }
   }
   function borrar_datos($id){
    try {
        $base = conectar('admin');
           $sentencia = $base->prepare("DELETE FROM datos WHERE id_posts=:id_posts");
           $sentencia->bindParam(':id_posts', $id);
           $sentencia->execute();
       $sentencia = null;
       $base = null;
   } catch (PDOException $e) {
       print $e->getMessage();
   }
   }
   
  function actualizar_post($id,$titulo,$decorta,$target_path,$deslarga,$autor){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE posts SET titulo_post=:titulo_post,descorta=:descorta,imagen=:imagen,deslarga=:deslarga,creador_post=:creador_post WHERE id_post=:id_post");
        $sentencia->bindParam(':titulo_post', $titulo);
        $sentencia->bindParam(':descorta', $decorta);
        $sentencia->bindParam(':imagen', $target_path);
        $sentencia->bindParam(':deslarga', $deslarga);
        $sentencia->bindParam(':creador_post', $autor);
        $sentencia->bindParam(':id_post', $id);
        $sentencia->execute();
        print 'Modificacion ejecutada';
        $sentencia = null;
        $base = null;
    } catch (Exception $e) {
        print $e->getMessage();
    }

   }
   function ver_clicks(){
    try {
        $base = conectar("admin"); 
        $sql2 = $base->prepare("SELECT contador_clicks FROM datos ORDER BY id_posts DESC LIMIT 5");
        $sql2->execute();
        $resultados2 = $sql2->fetchAll();
       $sql2 = null;
       $base = null;
       return $resultados2;
} catch (PDOException $e) {
    print $e->getMessage();
}  
   }
   function ver_clicks_todos(){
    try {
        $base = conectar("admin"); 
        $sql2 = $base->prepare("SELECT contador_clicks FROM datos ORDER BY id_posts DESC ");
        $sql2->execute();
        $resultados2 = $sql2->fetchAll();
       $sql2 = null;
       $base = null;
       return $resultados2;
} catch (PDOException $e) {
    print $e->getMessage();
}  
   }
   

?>
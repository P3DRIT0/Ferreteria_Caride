<?php 
include '../Config/conexiones_BD.php';
function cargar_datos_usuario($id){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
        $sentencia->bindParam(':id_usuario', $id);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        $sentencia=null;
        $base=null;
        return $resultados;
}  catch (PDOException $e) {
    die('No se pudo conectar: ' . $e->getMessage());
    }
}

function cargar_img_perfil($id){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT imagen_usuario FROM usuarios WHERE id_usuario=:id_usuario");
        $sentencia->bindParam(':id_usuario', $id);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados[0][0];
        $sentencia=null;
        $base=null;
}  catch (PDOException $e) {
    die('No se pudo conectar: ' . $e->getMessage());
    }
}
/**
 * Metodo que recibe por cabecera un email y la ruta de una imagen y a traves de la consulta update cambia dicha ruta para el usuario 
 * con ese email 
 * @param string $email 
 * @param string $img ruta de la imagen 
 */
function cambiar_img_perfil($id,$img){
     try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE usuarios SET imagen_usuario=:img WHERE id_usuario=:id_usuario");
        $sentencia->bindParam(':id_usuario', $id);
        $sentencia->bindParam(':img', $img);
        $sentencia->execute();
        $sentencia=null;
        $base=null;
     
}  catch (PDOException $e) {
    die('No se pudo conectar: ' . $e->getMessage());
    }
}
function actualizar_datos_usuario($telf,$direccion,$id){
    try {
    $base = conectar('admin');
       $sentencia = $base->prepare("UPDATE usuarios SET telf=:telf,direccion=:direccion WHERE id_usuario=:id_usuario");
       $sentencia->bindParam(':telf', $telf);
       $sentencia->bindParam(':direccion', $direccion);
       $sentencia->bindParam(':id_usuario', $id);
       $sentencia->execute();
       $sentencia=null;
       $base=null;
       }  catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
   }
}
 ?>
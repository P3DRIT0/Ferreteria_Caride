<?php
include '../Config/conexiones_BD.php';
function cargar_post($id){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM posts WHERE id_post=:id_post');
        $sentencia->bindParam(':id_post', $id);
        $sentencia->execute();
        $result = $sentencia->fetchAll();;
		$sentencia = null;
        $base = null;
        return $result;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}
function ver_clicks($id){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT contador_clicks FROM datos WHERE id_posts=:id_posts');
        $sentencia->bindParam(':id_posts', $id);
        $sentencia->execute();
        $result = $sentencia->fetchAll();;
		$sentencia = null;
        $base = null;
        return $result[0][0];
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}
function sumar_clicks($id,$contador_clicks){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare('UPDATE datos SET contador_clicks=:contador_clicks WHERE id_posts=:id_posts');
        $sentencia->bindParam(':contador_clicks', $contador_clicks);
        $sentencia->bindParam(':id_posts', $id);
        $sentencia->execute();
        $result = $sentencia->fetchAll();;
		$sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}
?>

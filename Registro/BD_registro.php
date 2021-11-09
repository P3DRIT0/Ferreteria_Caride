<?php

include '../Config/conexiones_BD.php';

/**
 * Método que recibe por cabecera los datos de un usuario nuevo para insertarlos 
 * en la base de datos
 * 
 * @param string $nombre Nombre
 * @param string $contraseña Contraseña
 * @param int $rol Rol del usuario que por defecto entra como 1 (usuario básico)
 */
function registrar_usuario($nombre, $contraseña) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO usuarios(nombre,psw) VALUES (:nombre,:psw)");
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':psw',$contraseña);
        $sentencia->execute();
//        print_r($base->errorInfo());
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
function id_usuario($nombre){
    echo $nombre;
      try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT id_usuario FROM usuarios where nombre=:nombre");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->execute();
        $result = $sentencia->fetchAll();
        return $result;
        $sentencia=null;
        $base=null;
} catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
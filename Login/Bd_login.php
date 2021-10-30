<?php
require_once '../Registro/BD_registro.php';


/**
 * Método que recibe un usuario y comprueba si esta registrado en la base de datos
 * 
 * @param string $usuario usuario electrónico
 * @return boolean Verdadero si existe el usuario con ese usuario en la base de datos
 */
function comprobar_usuario($usuario) {
    echo $usuario;
    try {
        $usuario_registrado = false;
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM usuarios WHERE nombre=:nombre');
        $sentencia->bindParam(':nombre', $usuario);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        print_r($result);
        if (!empty($result["nombre"])) {
            $usuario_registrado = true;
        }
        $sentencia = null;
        $base = null;
        return $usuario_registrado;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}

/**
 * Método que comprueba que la contraseña corresponda con ese usuario
 * 
 * @param string $contraseña Contraseña del usuario
 * @param string $usuario usuario electrónico del usuario
 * @return boolean Devuelve verdadero si el usuario y la contraseña coinciden con las de la base de datos
 */
function cotejar_contraseñas($contraseña, $usuario) {
    try {
        $credenciales_validas = false;
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM usuarios WHERE nombre=:usuario');
        $sentencia->bindParam(':usuario', $usuario);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        if (password_verify($contraseña, $result["psw"])) {
            $credenciales_validas = true;
        }
        $sentencia = null;
        $base = null;
        return $credenciales_validas;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}

/**
 * Método que crea una sesión y le vincula los datos recogidos de la base de datos 
 * para el usuario en cuestión
 * 
 * @param string $usuario usuario electrónico del usuario
 */
function crear_sesion($usuario) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM usuarios WHERE nombre=:usuario');
        $sentencia->bindParam(':usuario', $usuario);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        session_start();
        $id_usuario=id_usuario($usuario)[0][0];
        $_SESSION['id'] =$id_usuario; 
        $_SESSION['usuario'] = $result['nombre'];
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
    header("Location:../Panel_control.html");
}

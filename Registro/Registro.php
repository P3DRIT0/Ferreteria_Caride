<!DOCTYPE html>
<?php
require_once './BD_registro.php';
$nombre = $apellidos = $telefono = "";
$Err_contraseñas = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['contraseña']) && isset($_POST['contraseña2'])) {
        $nombre = $_POST['nombre'];
        $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
        $contraseña2 = password_hash($_POST['contraseña2'], PASSWORD_DEFAULT);
        if (!($_POST['contraseña'] == $_POST['contraseña2'])) {
            $Err_contraseñas = "Las contraseñas no coinciden";
        } else {
            registrar_usuario($nombre, $contraseña);
            session_start();
            $id_usuario=id_usuario($nombre)[0][0];
            $_SESSION['id'] =$id_usuario; 
            $_SESSION['usuario'] = $nombre;
            $_SESSION['rol'] = "Usuario_registrado";
            header('Location:../index.html');
        }
    } else {
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/estilo_login.css'>
</head>
<body>
    <div class="login">
        <h1>Bienvevido</h1>
        <form action="Registro.php" method="post">
            <input type="text" name="nombre" placeholder="Usuario" required="required" value="<?php echo $nombre ?>"/>
            <input type="password" name="contraseña" placeholder="Contraseña" required="required" />
            <input type="password" name="contraseña2" placeholder="Repetir contraseña" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
            <a style="color:red"><?php echo $Err_contraseñas; ?></a>
           
        </form>
    </div>
</body>
</html>
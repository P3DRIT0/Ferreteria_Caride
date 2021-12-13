<!DOCTYPE html>
<?php
require_once './Bd_login.php';
$usuario = "";
$Err_contraseñas = "";
$Err_email = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['contraseña']) && isset($_POST['usuario'])) {
        $contraseña = $_POST['contraseña'];
        $usuario = $_POST['usuario'];
        
        if (comprobar_usuario($usuario)) {
            if (cotejar_contraseñas($contraseña, $usuario)) {
                crear_sesion($usuario);
            } else {
                $Err_contraseñas = "Contraseña incorrecta";
            }
        } else {
            $Err_email = "Usuario incorrecto";
        }
    }
}
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/estilo_login.css'>
</head>
<body>
    <div class="login">
        <h1>Bienvenido</h1>
        <form method="post">
            <input type="text" name="usuario" placeholder="Usuario" required="required" />
            <input type="password" name="contraseña" placeholder="Contraseña" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">Entrar</button>
            <a style="color:red"><?php echo $Err_contraseñas; ?></a>
            <a style="color:red"><?php echo $Err_email; ?></a>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<?php
session_start();
include_once './BD_perfil.php';
$id= $_SESSION['id_usuario'];
$datos_usuario= cargar_datos_usuario($id);
$_SESSION["telf"] =$datos_usuario[0][5];
$_SESSION["direccion"] =$datos_usuario[0][6];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Usuario']) && isset($_POST['Direccion']) && isset($_POST['Telefono'])) {
        $usuario = actualizar_datos_usuario($_POST['Telefono'], $_POST['Direccion'],$_SESSION['id_usuario']);
        $_SESSION["telf"] = $_POST['Telefono'];
        $_SESSION["direccion"] = $_POST['Direccion'];
    }
    if (isset($_FILES['nuevaimagen']) && $_FILES['nuevaimagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_POST['nuevaimagen'];
        $mensaje_error;
//Obtener detalles del fichero
        $fileTmpPath = $_FILES['nuevaimagen']['tmp_name'];
        $fileName = $_FILES['nuevaimagen']['name'];
        $fileSize = $_FILES['nuevaimagen']['size'];
        $fileType = $_FILES['nuevaimagen']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
//Limpiar los caracteres especiales
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
//Creamos un array con las extensiones permitidas
        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $directorio = '../Perfil/Multimedia'; //Declaramos un  variable con la ruta donde guardaremos los archivos
//Validamos si la ruta de destino existe, en caso de no existir la creamos
            if (!file_exists($directorio)) {
//0777 son los permisos
                mkdir($directorio, 0777) or die("No se puede crear el directorio;n");
            }
            $dir = opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio . '/' . $newFileName; //Indicamos la ruta de destino, así como el nombre del archivo

            if (move_uploaded_file($fileTmpPath, $target_path)) {

                $imagen_actual_ruta = cargar_img_perfil($_SESSION['id_usuario']);
                $imagen_actual_aux = explode("/", $imagen_actual_ruta);
                $imagen_actual = end($imagen_actual_aux);
                //Aqui compruebo si la imagen por defecto es la que esta,si es el caso no la borro pero si no lo es borro la imagen anterior
                if ($imagen_actual === "default.png") {
                    cambiar_img_perfil($_SESSION['id_usuario'], $target_path);
                    header('Location:./Perfil.php');
                } else {
                    unlink($imagen_actual_ruta);
                    cambiar_img_perfil($_SESSION['id_usuario'], $target_path);
                    header('Location:./Perfil.php');
                }
            } else {
                echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }
            closedir($dir); //Cerramos el directorio de destino
        }
    } else {
        $mensaje_error = "El archivo introducido no es una imagen (jpg,gif,png)";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Perfil</title>

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
            crossorigin="anonymous"
            />
        <LINK REL=StyleSheet HREF="../css/estilo_perfil.css" TYPE="text/css" MEDIA=screen>
        <!--Fuentes -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap"
            rel="stylesheet"
            />
    </head>
    <body>
        <form action="Perfil.php" method="post" enctype="multipart/form-data">
            <section>
                <div class="container">
                    <div class="row">
                        <div
                            class="col-12 mx-auto"
                            style="height: 400px; margin-top: 100px"
                            >
                            <div class="row">
                                <div class="col-9">
                                    <div class="row"><h2 style="text-align: center;margin-top: 20px;text-decoration: underline;">Perfil</h2></div>
                                    <div class="row"><div class="col-5 m-auto my-5">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Nombre:<input type="text" id="Usuario" name="Usuario" style="border: 0" readonly="true"  value="<?php echo $_SESSION["usuario"] ?>"</li>
                                                <li class="list-group-item">Número de teléfono:<input type="text" id="Telefono" name="Telefono" style="border: 0" readonly="true" value="<?php echo $_SESSION["telf"] ?>"</li>
                                                <li class="list-group-item">Dirección: <input type="text" style="border: 0 " id="Direccion"  name="Direccion" readonly="true" value="<?php echo $_SESSION["direccion"] ?>"></li>
                                                <li class="list-group-item" ><a<input  type="button" title="Boton editar" class="boton_editar me-5 ms-3" onclick="Cambiarcampos()"><svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="#000000" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                                        </svg></a>
                                                    <input type="submit" class="btn btn-dark"  value="Guardar Cambios" />
                                                </li>
                                            </ul>
                                        </div>                                
                                        <div class="col-5 bg-dark">
                                            <div class="container">
                                                <div class="picture-container mt-5" >
                                                    <div class="picture">
                                                        <img src="<?php echo cargar_img_perfil($_SESSION['id_usuario']) ?>" class="picture-src" id="wizardPicturePreview" title="">
                                                        <input type="file" id="wizard-picture" name="nuevaimagen">
                                                    </div>
                                                    <h6 class="">Cambiar imagen </h6>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <a type="button" href="../Panel_control/Panel_control.php" class="btn_borrar btn btn-primary">Atras</a>
                                </div>
                            </div>
                            </body>
                            <!-- Separate Popper and Bootstrap JS -->
                            <script
                                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                                crossorigin="anonymous"
                            ></script>
                            <script src="../js/jquery-1.12.0.js"></script>
                            <script>
                                                    $(document).ready(function () {
                                                        // Prepare the preview for profile picture
                                                        $("#wizard-picture").change(function () {
                                                            readURL(this);
                                                        });

                                                    });
                                                    function readURL(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                                                            }
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                      var contador=true;
                                                    function Cambiarcampos() {                                                    
                                                        if (contador) {
                                                            $("#Telefono").prop('readonly', false);
                                                            $("#Telefono").css('border', '1px solid black');
                                                            $("#Direccion").prop('readonly', false);
                                                            $("#Direccion").css('border', '1px solid black');
                                                            contador=false;
                                                        }else{
                                                            $("#Telefono").prop('readonly', true);
                                                            $("#Telefono").css('border', '0px solid black');
                                                            $("#Direccion").prop('readonly', true);
                                                            $("#Direccion").css('border', '0px solid black');
                                                            contador=true;
                                                        }


                                                    }

                            </script>
                            <script
                                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
                                integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
                                crossorigin="anonymous"
                            ></script>
                            <!--Jquery-->
                            <script
                                src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"
                                type="text/javascript"
                            ></script>
                            </html>
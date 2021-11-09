<!DOCTYPE html>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Usuario']) && isset($_POST['Direccion']) && isset($_POST['Telefono'])) {
        $usuario = actualizar_datos_usuario($_POST['Usuario'], $_POST['Telefono'], $_POST['Direccion']);
        $_SESSION["usuario"] = $_POST['Usuario'];
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

                $imagen_actual_ruta = cargar_img_perfil($_SESSION["email"]);
                $imagen_actual_aux = explode("/", $imagen_actual_ruta);
                $imagen_actual = end($imagen_actual_aux);
                //Aqui compruebo si la imagen por defecto es la que esta,si es el caso no la borro pero si no lo es borro la imagen anterior
                if ($imagen_actual === "avatar_defecto.png" || $imagen_actual === "foto_perfil_trabajadores.png" || $imagen_actual === "foto_perfil_administradores.png") {
                    cambiar_img_perfil($_SESSION["email"], $target_path);
                    header('Location:./Perfil.php');
                } else {
                    unlink($imagen_actual_ruta);
                    cambiar_img_perfil($_SESSION["email"], $target_path);
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
<html>

<head>
    <title></title>
    <script type="text/javascript" src="..//js/jquery-1.12.0.js"></script>
    <link rel="stylesheet" href="../css/richtext.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../js/jquery.richtext.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
    <div class="contenedor">
        <div class="editor">
            <p class="titulo_post">Titulo del Post <input id="titulo" class="titulo" type="text" /></p>
            <p class="titulo_post">
                <a>Imagen post</a><input type="file" id="wizard-picture" name="nuevaimagen"> </p>
            <p class="titulo_post">Pequeña descripcion
                <textarea id="textarea" maxlength="130"></textarea><br>
                <span id="current_count">0</span>
                <span id="maximum_count">/130</span></p>

            <textarea id="texto_grande" class="content" name="textarea"></textarea>
            <br>
            <input type="submit" id="crear_form" class="btn btn-primary crear"  value="Crear post"/>
        </div>
       
        <div class="card_previsualizacion ">
        <button  type="button" id="swap" value="0" class="btn btn-primary swap">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"></path>
</svg>
          <span id="texto_boton" >Cambiar vista pagina</span>      
                
              </button>
        
            <div class="card ">
                <div class="picture">
                    <img src="" class="picture-src card-img-top" id="wizardPicturePreview" style="height: 230px;" title="">
                </div>
                <h5 class="card-title texto_inicial" id="titulo_card">Titulo de prueba cambiar a la izquierda</h5>
                <div id="card1" class="card-body">
                    
                    <p class="card-text texto_inicial" id="texto_card">
                        Texto de ejemplo cambialo en el apartado de pequeña descripción
                    </p>
                    <a href="#" class="btn btn-primary">Seguir leyendo</a>
                </div>
                <div id="card2" class="card-body d-none">
                        <p class="card-text texto_inicial" id="texto_card_estendido">
                            Texto de ejemplo cambialo en el apartado del editor de texto
                        </p>
                    </div>
            </div>

        </div>
    </div>
    </div>
            <form action="editor.php" id="form" class="d-none" method="post">
            <input id="form_titulo"  type="text" name="form_titulo" />
            <input id="form_imagen"  type="text" name="form_imagen" />  
            <textarea id="form_descorta" name="form_descorta"></textarea>  
            <textarea id="form_larga" name="form_deslarga"></textarea>
            </form>
</body>
<script>
    $(document).ready(function() {
        $("#form").click(function() {
       
        });

        $("#swap").click(function() {
        var val=$(this).val();
        if(val==0){
            console.log("entra");
            $("#card1").addClass("d-none")
            $("#card2").removeClass("d-none")
            $("#texto_boton").text("Cambiar vista elemento")
            $(this).val(1)
        }else{
            $("#card2").addClass("d-none")
            $("#card1").removeClass("d-none")
            $("#texto_boton").text("Cambiar vista pagina")
            $(this).val(0)
        }
        

        });
        $('.content').richText();
        $("#titulo").keyup(function() {
                var value = $(this).val();
                $("#titulo_card").text(value);
                $("#titulo_card").removeClass("texto_inicial");
                
            })
            // Prepare the preview for profile picture 
        $("#wizard-picture").change(function() {
            readURL(this);
        });

        $('#textarea').keyup(function() {
            var characterCount = $(this).val().length,
                current_count = $('#current_count'),
                maximum_count = $('#maximum_count'),
                count = $('#count');
            var value = $(this).val();
            $("#texto_card").text(value);
            $("#texto_card").removeClass("texto_inicial");
            current_count.text(characterCount);

            if (characterCount > 65) {
                current_count.addClass("texto_amarillo")
                maximum_count.addClass("texto_amarillo")
                if (characterCount > 125) {
                    current_count.removeClass("texto_amarillo")
                    maximum_count.removeClass("texto_amarillo")
                    current_count.addClass("texto_rojo")
                    maximum_count.addClass("texto_rojo")
                }
            } else {
                current_count.removeClass("texto_amarillo")
                maximum_count.removeClass("texto_amarillo")
                current_count.removeClass("texto_rojo")
                maximum_count.removeClass("texto_rojo")
            }
        });

        $(".richText-editor").keyup(function() {

            var value = $(".richText-initial").val();
            $("#texto_card_estendido").html(value);
            $("#texto_card_estendido").removeClass("texto_inicial");
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>

</html>
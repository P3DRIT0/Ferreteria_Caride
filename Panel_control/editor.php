<?php
require_once './Bd_Panel.php';
session_start();
$titulo_post="";
$img="";
$descorta="";
$deslarga="";
if (isset($_POST["todos_post"])) {
    $posts = cargar_todos_post();
}else{
$posts = cargar_post();
}
if (isset($_POST["numero_post_editar"])) {
  $numero_post=$_POST['numero_post_editar'];  
  $titulo_post=$posts[$numero_post][2];
  $img=$posts[$numero_post][4];
  $descorta=$posts[$numero_post][3];
  $deslarga=$posts[$numero_post][5];
}

if (isset($_POST['form_titulo']) && isset($_POST['form_descorta']) && isset($_POST['form_deslarga'])) {
    $num_post=$_POST['num_post'];
    $titulo=$_POST['form_titulo'];
    $decorta=$_POST['form_descorta'];
    $deslarga=$_POST['form_deslarga'];
    $autor=$_SESSION['id_usuario'];
    if ($_FILES["archivo"]["name"][0]!= null) {
        unlink($posts[$num_post][4]);
        $numero =$posts[$num_post][4];
        $rutas = array();
//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
//Validamos que el archivo exista
            if ($_FILES["archivo"]["name"][$key]) {
                $filename = $numero; //Obtenemos el nombre original del archivo
                $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                $directorio = '../Editor/Imagenes_Posts'; //Declaramos un  variable con la ruta donde guardaremos los archivos
//Validamos si la ruta de destino existe, en caso de no existir la creamos
                if (!file_exists($directorio)) {
//0777 son los permisos
                 mkdir($directorio, 0777) or die("No se puede crear el directorio;n");
                }
                $dir = opendir($directorio); //Abrimos el directorio de destino
                $target_path =$filename; //Indicamos la ruta de destino, así como el nombre del archivo
                $rutas[] = $target_path;
//Movemos y validamos que el archivo se haya cargado correctamente
//El primer campo es el origen y el segundo el destino
                if (move_uploaded_file($source, $target_path)) {
                    actualizar_post($posts[$num_post][0],$titulo,$decorta,$target_path,$deslarga,$autor);
				  header("Location:../Panel_control/Panel_control.php");
                    
                } else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                closedir($dir); //Cerramos el directorio de destino
            }
    
}		 
}else{
    actualizar_post($posts[$num_post][0],$titulo,$decorta,$posts[$num_post][4],$deslarga,$autor);
     header("Location:../Panel_control/Panel_control.php");
}

}
?>
<!DOCTYPE html>

<head>
    <title></title>
    <script type="text/javascript" src="..//js/jquery-1.12.0.js"></script>
    <link rel="stylesheet" href="../css/richtext.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../js/jquery.richtext.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
<form action="editor.php" id="form"  method="post" enctype="multipart/form-data">
    <div class="contenedor">
        <div class="editor">
            <p class="titulo_post">Titulo del Post <input id="titulo" value="<?php echo $titulo_post ?>" name="form_titulo" class="titulo" type="text" /></p>
            <p class="titulo_post">
                <a>Imagen post</a><input type="file"  id="wizard-picture" class="form-control" name="archivo[]" multiple=""> </p>
            <textarea id="form_descorta" class="d-none" name="form_descorta"></textarea>  
            <textarea id="form_deslarga" class="d-none" name="form_deslarga"></textarea>
            <input  type="text" class="d-none" value="<?php echo $numero_post?>" id="num_post" name="num_post"></input>
        </form>
            <p class="titulo_post">Pequeña descripcion
                <textarea id="textarea" maxlength="130"><?php echo $descorta ?></textarea><br>
                <span id="current_count">0</span>
                <span id="maximum_count">/130</span></p>

            <textarea id="texto_grande" class="content" name="textarea"><?php echo $deslarga ?></textarea>
            <br>
            <input type="submit" id="modificar_post" class="btn btn-primary crear"  value="Modificar post"/>
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
                    <img src="<?php echo $img?>" class="picture-src card-img-top" id="wizardPicturePreview" style="height: 230px;" title="">
                </div>
                <h5 class="card-title texto_inicial" id="titulo_card"><?php echo $titulo_post ?></h5>
                <div id="card1" class="card-body">
                    
                    <p class="card-text texto_inicial" id="texto_card">
                    <?php echo $descorta ?>
                    </p>
                    <a href="#" class="btn btn-primary">Seguir leyendo</a>
                </div>
                <div id="card2" class="card-body d-none">
                        <p class="card-text texto_inicial" id="texto_card_estendido">
                        <?php echo $deslarga ?>
                        </p>
                    </div>
            </div>
            <a type="button" href="../Panel_control/Panel_control.php" class="btn_borrar btn btn-primary">Atras</a>
        </div>
    </div>
    </div>
<script>
    $(document).ready(function() {
        $("#modificar_post").click(function() {
            $("#form_descorta").text($("#textarea").val());
            $("#form_deslarga").text($(".richText-initial").val());
            $("#form").submit()
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
</body>
</html>
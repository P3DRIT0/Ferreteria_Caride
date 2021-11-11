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
<form action="Procesar_editor.php" id="form"  method="post" enctype="multipart/form-data">
    <div class="contenedor">
        <div class="editor">
            <p class="titulo_post">Titulo del Post <input id="titulo" name="form_titulo" class="titulo" type="text" /></p>
            <p class="titulo_post">
                <a>Imagen post</a><input type="file" id="wizard-picture" class="form-control" name="archivo[]" multiple=""> </p>
            <textarea id="form_descorta" class="d-none" name="form_descorta"></textarea>  
            <textarea id="form_deslarga" class="d-none" name="form_deslarga"></textarea>
            </form>
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
<script>
    $(document).ready(function() {
        $("#crear_form").click(function() {
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
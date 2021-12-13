<!DOCTYPE html>
<?php
require_once './Bd_Panel.php';
$posts = cargar_todos_post();
$clicks=ver_clicks_todos();
session_start();

if (isset($_POST["numero_post"])) {
  $numero_post = $_POST['numero_post'];
  borrar_post($posts[$numero_post][0]);
  borrar_datos($posts[$numero_post][0]);
  unlink($posts[$numero_post][4]);
 header("Location:../Panel_control/Panel_control.php");
}
?>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel='stylesheet' type='text/css' media='screen' href='../css/estilo_Panel.css'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <title>Gestionar Publicaciones</title>
</head>

<body>
<a type="button" href="../Panel_control/Panel_control.php" class="btn_borrar btn btn-primary">Atras</a>
      <div class="col py-3" style="height: 900px;">
        <div class="contenedor_post">

          <!--Popular-->
          <div class="card">
            <div class="card-header bg-dark">Publicaciones recientes</div>
            <div class="panel-content">

              <table id="dtable" class="table">
                <?php for ($i = 0; $i < count($posts); $i++) {
                  echo ' <tr>';   
                  echo ' <td class="texto texto' . $i . '"> <form id="a' . $i . '_post" action="../Pagina_post/Post_Página.php" method="post" ><span class="badge badge-info bg-dark">'.$clicks[$i][0].'</span><a class="posta" id="a' . $i . '" href="#" >  ' . $posts[$i][2] . ' </a></td>';
                  echo '<input type="text" name="id_post" value=' . $posts[$i][0] .' class="d-none" id="id_post">';
                  echo '</form> <td>' . $posts[$i][1] . '<button type="button" id="borrar" value="' . $i . '" class="borrar btn btn-light bi bi-trash-fill"></button> <button type="button" id="editar" value="' . $i . '" class="editar btn btn-light bi bi-pencil-square"></button> </td>';
                  echo ' </tr>';
                }
                ?>
                </tr>
              </table>

            </div>
          </div>
          <form id="form_borrar" action="Gestionar_publicaciones.php" method="post">
            <!--End Popular-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Borrar Post </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Esta seguro que deseas eliminar el post con el titulo <b id="titulo_post"></b>
                  </div>
                  <div class="modal-footer">
                    <input type="text" id="numero_post" name="numero_post" class="d-none"></input>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_borrar" class="btn_borrar btn btn-primary">Borrar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <form id="form_editar" action="editor.php" method="post" class="d-none">
            <input type="text" id="numero_post_editar" name="numero_post_editar" class="d-none"></input>
            <input type="text" name="todos_post" value="todos" class="d-none"></input>
          </form>
         
        </div>
       
      </div>
     
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="../js/jquery-1.12.0.js"></script>
  <script>
    $(document).ready(function() {
      $(".posta").click(function() {
        var id = $(this).attr("id");
        console.log(id);
        $("#" + id+"_post").submit();
      });
      $(".borrar").click(function() {
        var numeropost = $(this).val();
        var titulo = " ";
        titulo = $("#a" + numeropost).text();
        $("#titulo_post").text(titulo)
        $("#staticBackdrop").modal('show')
        $(".btn_borrar").click(function() {
          $("#numero_post").val(numeropost);
          $("#form_borrar").submit();
        });
      });
      $(".editar").click(function() {
        var numeropost = $(this).val();
        console.log(numeropost)
        $("#numero_post_editar").val(numeropost);
        $("#form_editar").submit();
      });
    });
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
<?php
require_once './BD_registro.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resultados = lista_users();
if (isset($_POST["id_usuario"])) {
    $id_usuario = $_POST['id_usuario'];
    borrar_usuario($id_usuario);
    header("Location:../Registro/Borrar_usuario.php");
}
?>

<html>
    <head>
        <!-- Bootstrap CSS -->
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/estilo_Panel.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <title>Borrar habitacion</title>
    </head>
    <body>
    <div class="col py-3" style="height: 900px;">
        <div class="contenedor_post">

          <!--Popular-->
          <div class="card">
            <div class="card-header bg-dark">Usuarios</div>
            <div class="panel-content">

              <table id="dtable" class="table">
                <?php for ($i = 0; $i < count($resultados); $i++) {
                  echo ' <tr>';   
                  echo ' <td class=" texto' . $i . '"> <form id="a' . $i . '_post" action="../Pagina_post/Post_Página.php" method="post" ><label  href="#" ></td> <td>ID:<a id="a' . $i . '" href="#">' . $resultados[$i][0] . '</a> </td> <td> Nombre:<a href="#"> ' . $resultados[$i][1] . '</a></td><td>  Telefono:<a href="#">' . $resultados[$i][5] . '</a> </td> <td> Calle:<a href="#">' . $resultados[$i][6] . '</a></td> </label></td>';
                  echo '<input type="text" name="id_post" value=' . $resultados[$i][0] .' class="d-none" id="id_post">';
                  echo '</form> <td><button type="button" id="borrar" value="' . $i . '" class="borrar btn btn-light bi bi-trash-fill"></button></td>';
                  echo ' </tr>';
                }
                ?>
                </tr>
              </table>

            </div>
          </div>
          <form id="form_borrar" action="Borrar_usuario.php" method="post">
            <!--End Popular-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Borrar Post </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Esta seguro que deseas eliminar el usuario con el id <b id="titulo_post"></b>
                  </div>
                  <div class="modal-footer">
                    <input type="text" id="id_usuario" name="id_usuario" class="d-none"></input>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_borrar" class="btn_borrar btn btn-primary">Borrar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <a type="button" href="../Panel_control/Panel_control.php" class="btn_borrar btn btn-primary">Atras</a>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/jquery-1.12.0.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".borrar").click(function() {
        var numeropost = $(this).val();
        var titulo = " ";
        titulo = $("#a" + numeropost).text();

        $("#titulo_post").text(titulo)
        $("#staticBackdrop").modal('show')
        $(".btn_borrar").click(function() {
          $("#id_usuario").val(titulo);
         $("#form_borrar").submit();
        });
    });
      });
      </script>
</html>
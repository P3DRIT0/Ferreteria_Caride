<!DOCTYPE html>
<?php
require_once './Bd_Panel.php';
$posts = cargar_post();
$clicks=ver_clicks();
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
  <title>Panel de Control</title>
</head>

<body>
  <nav role="navigation" class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Panel de Control</a>
      <a href="./Log_out.php" class="nav-link ms-auto"><span class="bi bi-lock-fill"> Logout</span> </a>
    </div>
  </nav>


  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
          <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-3 d-none d-sm-inline"></span>
          </a>
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
              <a href="https://prueba.ferreteriacaride.es/" class="nav-link align-middle px-0">
                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
              </a>
            </li>
            <li>
              <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                <i class="fs-4 bi bi-card-text"></i> <span class="ms-1 d-none d-sm-inline">Publicaciones</span> </a>
              <ul class="collapse  nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                  <a href="/Editor/editor.php" class="nav-link px-0"><i class="bi bi-file-earmark-plus"></i> <span class="d-none d-sm-inline">Añadir publicacion</span></a>
                </li>
                <li>
                  <a href="./Gestionar_publicaciones.php" class="nav-link px-0"><i class="bi bi-box-arrow-left"></i> <span class="d-none d-sm-inline">Gestion publicacion</span></a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Gestion usuarios</span></a>
              <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                <li class="w-100">
                  <a href="/Registro/Registro.php" class="nav-link px-0"> <i class="bi bi-person-plus"></i> <span class="d-none d-sm-inline">Añadir Usuario</span></a>
                </li>
                <li>
                  <a href="../Registro/Borrar_usuario.php" class="nav-link px-0"> <i class="bi bi-person-dash"></i> <span class="d-none d-sm-inline">Borrar Usuario</span></a>
                </li>
              </ul>

            <hr>
            <div class="dropdown pb-4">
              <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo $_SESSION['img_perfil'] ?>" alt="" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['usuario'] ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a href="../Perfil/Perfil.php" class="dropdown-item">Perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Configuración</a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>

      <div class="col py-3">
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
          <form id="form_borrar" action="Panel_control.php" method="post">
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
            </input>
          </form>

          <canvas id="myChart" width="400" height="90"></canvas>
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

  <!-- Grafica  -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    (async () => {
      const labels = await fetch("./Graficas.php");
      const respuesta = await labels.json();

      const titulos = respuesta.labels;
      const clicks = respuesta.clicks;

      const ctx = document.getElementById('myChart').getContext('2d');
      const myChart = new Chart(ctx, {

        type: 'bar',
        data: {
          labels: titulos,
          datasets: [{
            label: 'Clicks en los posts recientes',
            data: clicks,
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

    })();
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
<!DOCTYPE html>
<?php
require_once './Bd_Panel.php';
$posts=cargar_post();
session_start();

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/estilo_Panel.css'>
    <title>Panel de Control</title>
  </head>
  <body>
    <nav role="navigation" class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Panel de Control</a>  
          <a href="#" class="nav-link ms-auto"><span class="bi bi-lock-fill"> Logout</span> </a>
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
                                            <a href="#" class="nav-link px-0"><i class="bi bi-file-earmark-x"></i> <span class="d-none d-sm-inline">Borrar publicacion</span></a>
                                        </li>
                                        <li>
                                          <a href="#" class="nav-link px-0"><i class="bi bi-box-arrow-left"></i> <span class="d-none d-sm-inline">Modificar</span></a>
                                      </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                        <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Gestion usuarios</span></a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                        <li class="w-100">
                                            <a href="/Registro/Registro.php" class="nav-link px-0"> <i class="bi bi-person-plus"></i>  <span class="d-none d-sm-inline">Añadir Usuario</span></a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <i class="bi bi-person-dash"></i>  <span class="d-none d-sm-inline">Borrar Usuario</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                        <li class="w-100">
                                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                                        </li>
                                    </ul>
                                </li>
                            
                            <hr>
                            <div class="dropdown pb-4">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                    <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['usuario']?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    <li><a class="dropdown-item" >Perfil</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Confifuracion</a></li>
                                </ul>
                            </div>
                          </ul>
                        </div>
                    </div>
                    
                    <div class="col py-3">
          <div class="contenedor_post">
            
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><span class="bi bi-house-door"></span> Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ul>
      
            <!--Popular-->
            <div class="card">
              <div class="card-header bg-dark">Publicaciones recientes</div>
              <div class="panel-content">
      
                <table id="dtable" class="table">
					<?php for ($i=0; $i <count($posts); $i++) { 
						echo ' <tr>';
    					echo ' <td class="texto"><span class="badge badge-info bg-dark">12</span><a href="#">  '.$posts[$i][titulo_post].' </a></td>';
						echo ' <td><span class="bi bi-calendar-week-fill"></span>'.$posts[$i][fecha_creacion].'</td>';
						echo ' </tr>';
						}    
					?>
                    <td colspan="2">
                      <ul class="pagination">
                        <li class="active page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">Last</a></li>
                      </ul>
                    </td>
                  </tr>
      
                </table>
      
              </div>
            </div>
            <!--End Popular-->
      
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
    <script>$(document).ready(function() {
        $('#dtable').DataTable();
    } );</script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

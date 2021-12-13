<!DOCTYPE html>
<?php
include './Bd_post.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_post'])) {
        $id=$_POST['id_post'];
         $post=cargar_post($id);
         $cantidad_clicks=ver_clicks($id);
         $cantidad_clicks=$cantidad_clicks+1;
         sumar_clicks($id,$cantidad_clicks);
    }
}
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/estilo_post.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<header>
    <div class="header-banner" style="background-image:url(<?php echo $post[0][4] ?>)";>
        <h1><?php echo $post[0][2]?></h1>
    </div>
    <div class="clear"></div>
</header>
<a  style="margin-left: 5%;" type="button" href="../Pagina_principal/Index.php#novedades" class="btn_borrar btn btn-primary">Atras</a>
<section class="content">
    <article>
       <?php echo $post[0][5]?>
    </article>
   
</section> 

</html>
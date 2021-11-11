<?php
include './Bd_Editor.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['form_titulo']) && isset($_POST['form_descorta']) && isset($_POST['form_deslarga'])) {
    $titulo=$_POST['form_titulo'];
    $decorta=$_POST['form_descorta'];
    $deslarga=$_POST['form_deslarga'];
    $autor=$_SESSION['id_usuario'];
    if (isset($_FILES)) {
        $numero =cargar_nombre();
        $rutas = array();
//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
//Validamos que el archivo exista
            if ($_FILES["archivo"]["name"][$key]) {

                $numero++;
                $filename = $numero . ".jpg"; //Obtenemos el nombre original del archivo
                $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                $directorio = '../Editor/Imagenes_Posts'; //Declaramos un  variable con la ruta donde guardaremos los archivos
//Validamos si la ruta de destino existe, en caso de no existir la creamos
                if (!file_exists($directorio)) {
//0777 son los permisos
                 mkdir($directorio, 0777) or die("No se puede crear el directorio;n");
                }
                $dir = opendir($directorio); //Abrimos el directorio de destino
                $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
                $rutas[] = $target_path;
//Movemos y validamos que el archivo se haya cargado correctamente
//El primer campo es el origen y el segundo el destino
                if (move_uploaded_file($source, $target_path)) {
                    guardar_posts($titulo,$decorta,$filename,$deslarga,$autor);
					echo "llega";
					header("Location:../Panel_control/Panel_control.php");
                    
                } else {
                    echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                }
                closedir($dir); //Cerramos el directorio de destino
            }
    
}		 
}

}
}
?>
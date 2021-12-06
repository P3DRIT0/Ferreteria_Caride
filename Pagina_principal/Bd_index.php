<?php
require "../Config/conexiones_BD.php";
function cargar_post(){
    try {
        $base = conectar("admin"); 
        $sql = $base->prepare("SELECT * FROM posts ORDER BY id_post DESC LIMIT 5");
        $sql->execute();
        $resultados = $sql->fetchAll();
        return $resultados;
         $sql = null;
        $base = null;
} catch (PDOException $e) {
    print $e->getMessage();
}
}
?>
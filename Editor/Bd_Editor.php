<?php
include '../Config/conexiones_BD.php';
function guardar_posts($titulo,$decorta,$imagen,$deslarga,$creador_post){
    try {
        $base = conectar("admin");
        $sql = $base->prepare("INSERT INTO posts(titulo_post,descorta,imagen,deslarga,creador_post) VALUES (:titulo_post,:descorta,:imagen,:deslarga,:creador_post)");
        $sql->bindParam(":titulo_post", $titulo);
        $sql->bindParam(":descorta", $decorta);
        $sql->bindParam(":imagen", $imagen);
        $sql->bindParam(":deslarga", $deslarga);
        $sql->bindParam(":creador_post", $creador_post);
        $sql->execute();
        $sql = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
		return false;
    }
}
function crear_contador($contador,$id_post){
    echo $contador,$id_post;
    try {
    $base = conectar("admin");
    $sql = $base->prepare("INSERT INTO datos(contador_clicks,id_posts) VALUES (:contador_clicks,:id_posts)");
    $sql->bindParam(":contador_clicks",$contador);
    $sql->bindParam(":id_posts",$id_post);
    $sql->execute();
    $sql = null;
    $base = null;
} catch (PDOException $e) {
    print $e->getMessage();
    return false;
}
}



function cargar_nombre(){
    try {
    $base = conectar("admin"); 
    $sql = $base->prepare("SELECT id_post FROM posts ORDER BY id_post DESC LIMIT 1");
    $sql->execute();
	$resultados = $sql->fetchAll();
	return $resultados[0][0];
	print_r($resultados);
    $sql = null;
    $base = null;
} catch (PDOException $e) {
    print $e->getMessage();
}
	}
?>
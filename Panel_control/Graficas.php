<?php
include '../Config/conexiones_BD.php';
    try {
        $base = conectar("admin"); 
        $sql = $base->prepare("SELECT titulo_post  FROM posts ORDER BY id_post DESC LIMIT 5");
        $sql->execute();
        $resultados = $sql->fetchAll();
        $sql2 = $base->prepare("SELECT contador_clicks FROM datos ORDER BY id_posts DESC LIMIT 5");
        $sql2->execute();
        $resultados2 = $sql2->fetchAll();
        $post=array();
        $clicks=array();
        for ($i=0; $i <count($resultados2); $i++) { 
         array_push($post,$resultados[$i]['titulo_post']);
         array_push($clicks,$resultados2[$i][0]);
        }
        $respuesta=[
            "labels"=> $post,
            "clicks"=> $clicks
        ];
       echo json_encode($respuesta);
       $sql = null;
       $sql2 = null;
       $base = null;
} catch (PDOException $e) {
    print $e->getMessage();
}

   
?>
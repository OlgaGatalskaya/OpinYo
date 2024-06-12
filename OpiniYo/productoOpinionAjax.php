<?php

include 'func.php';
global $db;

if (isset($_POST["IDProducto"])) {
    $IDProducto = intval($_POST["IDProducto"]);
}

$sql = "SELECT * FROM producto WHERE IDProducto = " . $IDProducto;

$objeto = $db->Execute($sql);
$resultado = [];
if($objeto -> RecordCount() > 0){
    while (!$objeto ->EOF){
        $IDProducto = $objeto ->fields["IDProducto"];
        $NombreProducto = $objeto ->fields["NombreProducto"];
        $ImgProducto = $objeto ->fields["ImagenProducto"];
        $resultado [] = [

            "IDProducto" => $IDProducto,
            "NombreProducto" =>  $NombreProducto,
            "ImagenProducto" => $ImgProducto
        ];


        $objeto->MoveNext();
    }

    $objeto->Close();
}




<?php

include 'func.php';

global $db;

header('Content-Type: application/json');

$elementoBuscado = $_POST["elementoBuscado"] ?? null;

$buscador = mysqli_real_escape_string($db->cnx, $elementoBuscado);
$buscador = strtolower($buscador);

$sql = "SELECT *
            FROM Producto
            JOIN Subcategoria ON Producto.SubcategoriaProducto = Subcategoria.IDSubcategoria
            WHERE (Producto.ActivoProducto = 'Si' AND Subcategoria.ActivoSubcategoria = 'Si')
            AND (LOWER(Producto.NombreProducto) LIKE '%$buscador%' OR LOWER(Subcategoria.NombreSubcategoria) LIKE '%$buscador%')";


$objeto = $db->Execute($sql);
$resultado = [];
if($objeto -> RecordCount() > 0){
    while (!$objeto ->EOF){
        $IDProducto = $objeto ->fields["IDProducto"];
        $NombreProducto = $objeto ->fields["NombreProducto"];
        $NombreSubcategoria = $objeto ->fields["NombreSubcategoria"];
        $ImgProducto = $objeto ->fields["ImagenProducto"];
        $resultado [] = [

            "IDProducto" => $IDProducto,
            "NombreProducto" =>  $NombreProducto,
            "NombreSubcategoria" =>  $NombreSubcategoria,
            "ImagenProducto" => $ImgProducto
        ];


        $objeto->MoveNext();
    }

    $objeto->Close();
}


print json_encode($resultado);




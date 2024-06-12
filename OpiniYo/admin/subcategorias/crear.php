<?php

include '../../func.php';

global $db;

$data = json_decode(file_get_contents('php://input'),true);

$NombreSubcategoria = $data['NombreSubcategoria'];
$CategoriaSubcategoria = intval($data['CategoriaSubcategoria']);
$NombreCategoria = $data['NombreCategoria'];

$sql = "INSERT INTO subcategoria (FechaAltaSubcategoria, NombreSubcategoria, CategoriaSubcategoria) VALUES (NOW(), '$NombreSubcategoria', $CategoriaSubcategoria)";

try{
    global $db;
    $db->Execute($sql);

    $ultimoId = mysqli_insert_id($db->cnx);

    $datos = [
        'IDSubcategoria' => $ultimoId,
        'NombreSubcategoria' => $NombreSubcategoria,
        'NombreCategoria' => $NombreCategoria
    ];



    header('Content-Type: application/json');
    print json_encode($datos);

} catch (PDOException $error){
    print json_encode(['error'=>$error->getMessage()]);
}


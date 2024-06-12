<?php
include '../../conecta.php';
$data = json_decode(file_get_contents('php://input'),true);
$nombreCategoria = $data['NombreCategoria'];
$sql = "INSERT INTO categoria (FechaAltaCategoria, NombreCategoria) VALUES (now(), '$nombreCategoria')";

try{
    global $db;
    $db->Execute($sql);

    $ultimoId = mysqli_insert_id($db->cnx);

    $datos = [
        'IDCategoria' => $ultimoId,
        'NombreCategoria' => $nombreCategoria
    ];



    header('Content-Type: application/json');
    print json_encode($datos);

} catch (PDOException $error){
    print json_encode(['error'=>$error->getMessage()]);
}

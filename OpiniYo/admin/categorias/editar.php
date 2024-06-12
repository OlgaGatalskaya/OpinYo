<?php

include '../../func.php';
global $db;
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['IDCategoria']) && isset($data['NombreCategoria'])) {
    $idCategoria = mysqli_real_escape_string($db->cnx, $data['IDCategoria']);
    $nombreCategoria = mysqli_real_escape_string($db->cnx, $data['NombreCategoria']);

    $query = "UPDATE categoria SET NombreCategoria = '$nombreCategoria' WHERE IDCategoria = '$idCategoria'";
    $resultado = $db->Execute($query);

    if ($resultado->RecordCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'La categoría fue editada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se puede editar la categoría']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}

$db->Close();

?>
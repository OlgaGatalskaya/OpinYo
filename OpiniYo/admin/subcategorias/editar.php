<?php


include '../../func.php';
global $db;
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['IDSubcategoria']) && isset($data['NombreSubcategoria'])) {
    $idSubcategoria = mysqli_real_escape_string($db->cnx, $data['IDSubcategoria']);
    $nombreSubcategoria = mysqli_real_escape_string($db->cnx, $data['NombreSubcategoria']);

    $query = "UPDATE subcategoria SET NombreSubcategoria = '$nombreSubcategoria' WHERE IDSubcategoria = '$idSubcategoria'";
    $resultado = $db->Execute($query);

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'La subcategoría fue editada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se puede editar la subcategoría']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}

$db->Close();


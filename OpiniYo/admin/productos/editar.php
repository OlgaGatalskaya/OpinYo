<?php

include '../../func.php';
global $db;

header('Content-Type: application/json');

$IDProducto = $_POST["IDProducto"] ?? null;
$NombreProducto = $_POST['NombreProducto'] ?? null;
$SubcategoriaNombre = $_POST['SubcategoriaNombre'] ?? null;

if (!$IDProducto || !$NombreProducto || !$SubcategoriaNombre) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$rutaArchivo = '../../imgProductos/';
$nombreArchivo = basename($_FILES['ImagenProducto']['name'] ?? "");
$file = $rutaArchivo . $nombreArchivo;
$updateImage = "";

if ($nombreArchivo && $_FILES['ImagenProducto']['error'] === UPLOAD_ERR_OK) {
    if (move_uploaded_file($_FILES['ImagenProducto']['tmp_name'], $file)) {
        $updateImage = ", ImagenProducto = '$nombreArchivo'";
    }
}

$IdProducto = mysqli_real_escape_string($db->cnx, $IDProducto);
$nombreProducto = mysqli_real_escape_string($db->cnx, $NombreProducto);

$query = "UPDATE producto SET NombreProducto = '$nombreProducto' $updateImage WHERE IDProducto = '$IdProducto'";
$resultado = $db->Execute($query);

if ($resultado) {
    echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'No se puede actualizar el producto', 'error' => mysqli_error($db->cnx)]);
}

$db->Close();

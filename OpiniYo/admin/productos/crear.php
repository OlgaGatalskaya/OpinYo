<?php

include '../../func.php';

global $db;

header('Content-Type: application/json'); // Установите этот заголовок в самом начале

/*$post_data = json_encode(['POST' => $_POST, 'FILES' => $_FILES], JSON_PRETTY_PRINT);
echo $post_data;
file_put_contents('debug.txt', $post_data);  // Сохраняем данные в файл для изучения без влияния на вывод в браузер
exit;*/


$message = '';
$NombreProducto = $_POST['NombreProducto'];

$rutaArchivo = '../../imgProductos/';
$nombreArchivo = basename($_FILES['ImagenProducto']['name']);
$file = $rutaArchivo . $nombreArchivo;

if (isset($_FILES['ImagenProducto']) && $_FILES['ImagenProducto']['error'] === UPLOAD_ERR_OK) {
    if (move_uploaded_file($_FILES['ImagenProducto']['tmp_name'], $file)) {
        $message = "El archivo esta cargado correctamente";
    } else {
        $message = "El archivo no pudo ser cargado";
    }
} else {
    $message = "El archivo no pudo ser cargado";
}

$SubcategoriaProducto = intval($_POST['SubcategoriaProducto']);
$SubcategoriaNombre = $_POST['SubcategoriaNombre'];

$sql = "INSERT INTO producto (FechaAltaProducto, NombreProducto, ImagenProducto, SubcategoriaProducto) VALUES (NOW(), '$NombreProducto', '$nombreArchivo', $SubcategoriaProducto)";

$db->Execute($sql);
$ultimoId = mysqli_insert_id($db->cnx);

$response = [
    'message' => $message,
    'IDProducto' => $ultimoId,
    'NombreProducto' => $NombreProducto,
    'ImagenProducto' => $nombreArchivo,
    'SubcategoriaProducto' => $SubcategoriaProducto,
    'SubcategoriaNombre' => $SubcategoriaNombre
];

echo json_encode($response);
exit;




<?php

include 'func.php';

global $db;

//header('Content-Type: application/json');

$message = '';

$NombreProducto = $_POST['NombreProducto'];

$rutaArchivo = 'imgProductos/';
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

$Comentario = $_POST['comentario'] ?? null;
$Clasificacion = $_POST['clasificacion'] ?? null;
$IDProducto = $ultimoId;
$IDUsuario = $_SESSION['user_id'];

$sql1 = "INSERT INTO opinion (FechaAltaOpinion, ActivoOpinion, ClasificacionOpinion, ComentarioOpinion, FechaOpinion, ProductoOpinion, UsuarioOpinion)
        VALUES (now(), 'Si', '$Clasificacion', '$Comentario', now(), '$IDProducto', '$IDUsuario')";

$db->Execute($sql1);
$ultimoId2 = mysqli_insert_id($db->cnx);

// Получение только что добавленного мнения или других связанных данных
/*$sql2 = "SELECT * FROM opinion WHERE IDOpinion = '$ultimoId2'";
$result = $db->Execute($sql2);
$data = [];
if ($result->RecordCount() > 0) {
    while (!$result->EOF) {
        $data[] = $result->fields; // Собираем данные для JSON
        $result->MoveNext();
    }
}*/

/*$response = [
    'success' => true,
    'data' => $data,
    'message' => 'Todo bien'
];*/

$message = 'todo bien';

//echo json_encode($response);
print $message;
exit;


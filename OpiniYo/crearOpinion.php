<?php

include 'func.php';

global $db;


header('Content-Type: application/json');

$Comentario = $_POST['comentario'] ?? null;
$Clasificacion = $_POST['clasificacion'] ?? null;
$IDProducto = $_POST['IDProducto'] ?? null;
$IDUsuario = $_SESSION['user_id'];
$mensaje = '';


$sql1 = "INSERT INTO opinion (FechaAltaOpinion, ActivoOpinion, ClasificacionOpinion, ComentarioOpinion, FechaOpinion, ProductoOpinion, UsuarioOpinion)
        VALUES (now(), 'Si', '$Clasificacion', '$Comentario', now(), '$IDProducto', '$IDUsuario')";

$db->Execute($sql1);
$ultimoId = mysqli_insert_id($db->cnx);

// Получение только что добавленного мнения или других связанных данных
$sql2 = "SELECT * FROM opinion WHERE IDOpinion = '$ultimoId'";
$result = $db->Execute($sql2);
$data = [];
if ($result->RecordCount() > 0) {
    while (!$result->EOF) {
        $data[] = $result->fields; // Собираем данные для JSON
        $result->MoveNext();
    }
}

$response = [
    'success' => true,
    'data' => $data,
    'message' => 'Todo bien'
];

echo json_encode($response);
exit;





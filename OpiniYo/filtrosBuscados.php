<?php

include 'func.php';

global $db;

header('Content-Type: application/json');

$limit = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql2 = "SELECT count(IDOpinion) as total FROM opinion";
$objeto2 = $db->Execute($sql2);
$resultado2 = [];
if ($objeto2 -> RecordCount() > 0){
    while (!$objeto2 -> EOF){
        $total = $objeto2->fields["total"];
        $resultado2 [] = [
            "total" =>  $total,
        ];
        $objeto2->MoveNext();
    }
    $objeto2->Close();
}
$total = $resultado2[0]['total'];
$pages = ceil($total/$limit);

$showPagination = $pages > 1;

$Previous = max(1, $page - 1);
$Next = min($page + 1, $pages);


$previousDisabled = ($page <= 1) ? 'disabled' : '';
$nextDisabled = ($page >= $pages) ? 'disabled' : '';


$tipo = $_POST['tipo'];

$buscador = $_SESSION['buscador'];

$opiniones_ordenados = ordenarOpinionBuscado($tipo, $buscador, $start, $limit);

print json_encode($opiniones_ordenados);
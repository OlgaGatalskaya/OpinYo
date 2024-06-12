<?php
include '../../func.php';

try{
    global $db;

    $sql = "SELECT * FROM subcategoria sub
    JOIN categoria cat ON sub.CategoriaSubcategoria = cat.IDCategoria
    ORDER BY sub.CategoriaSubcategoria ASC
    ";
    $objeto_subcategorias = $db->Execute($sql);
    $todas_subcategorias = [];

    if($objeto_subcategorias -> RecordCount() > 1){
        while (!$objeto_subcategorias ->EOF){
            $IDSubcategoria = $objeto_subcategorias ->fields["IDSubcategoria"];
            $NombreSubcategoria = $objeto_subcategorias ->fields["NombreSubcategoria"];
            $NombreCategoria = $objeto_subcategorias ->fields["NombreCategoria"];
            $todas_subcategorias [] = [
                "IDSubcategoria" =>  $IDSubcategoria,
                "NombreSubcategoria" =>  $NombreSubcategoria,
                "NombreCategoria" =>  $NombreCategoria,
            ];

            $objeto_subcategorias->MoveNext();
        }

        $objeto_subcategorias->Close();
    }
    header('Content-Type: application/json');
    print json_encode($todas_subcategorias);

}catch (PDOException $error) {
    print $error->getMessage();
}

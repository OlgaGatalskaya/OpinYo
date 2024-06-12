<?php
include '../../func.php';

try{
    global $db;
    $sql = "SELECT * FROM categoria";
    $object_datos = $db->Execute($sql);
    $todas_categorias = [];

    if($object_datos->RecordCount()>0){
        while(!$object_datos->EOF){
            $IDCategoria = $object_datos->fields["IDCategoria"];
            $NombreCategoria = $object_datos->fields["NombreCategoria"];
            $todas_categorias [] = [
                "IDCategoria" => $IDCategoria,
                "NombreCategoria" => $NombreCategoria
            ];
            $object_datos->MoveNext();
        }
        $object_datos->Close();

    }

    header('Content-Type: application/json');
    print json_encode($todas_categorias);

}catch (PDOException $error) {
    print $error->getMessage();
}

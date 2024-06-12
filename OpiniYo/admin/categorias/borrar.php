<?php
include '../../func.php';

$data = json_decode(file_get_contents('php://input'), true);

    try{
        global $db;
        if(isset($data["IDCategoria"])) {
            $idCategoria = mysqli_real_escape_string($db->cnx, $data['IDCategoria']);
            $sql = "DELETE FROM categoria WHERE IDCategoria = '$idCategoria'";
            $resultado = $db->Execute($sql);


            if($resultado -> RecordCount() == 0){ //TODO кажется это не работает
                print json_encode(['success' => false, 'message' => 'No se puede eliminar la categoría']);
            } else {
                print json_encode(['success' => true, 'message' => 'La categoría fue eliminada']);
            }
        } else {
            print json_encode(['success'=>false, 'message' => 'No existe id']);
        }

    }catch (PDOException $error){
        print json_encode(['success'=>false, 'message'=>$error->getMessage()]);
    }


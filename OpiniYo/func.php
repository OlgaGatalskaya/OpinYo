<?php

include 'conecta.php';
ob_start();
session_start();

function debug($data){
    print '<pre>' . print_r($data, 1) . '</pre>';
}

//función para demostrar categorías
function todas_categorias (): array{
    global $db;
    $sql = "SELECT * FROM categoria";
    $objeto_categorias = $db->Execute($sql);
    $todas_categorias = [];
    if($objeto_categorias -> RecordCount() > 1){
        while (!$objeto_categorias ->EOF){
            $IDCategoria = $objeto_categorias ->fields["IDCategoria"];
            $NombreCategoria = $objeto_categorias ->fields["NombreCategoria"];
            $todas_categorias [] = [
                "IDCategoria" =>  $IDCategoria,
                "NombreCategoria" =>  $NombreCategoria,
            ];

            $objeto_categorias->MoveNext();
        }

        $objeto_categorias->Close();
    }

    return $todas_categorias;
}
function todas_subcategorias () : array{
    global $db;

    $sql = "SELECT * FROM subcategoria sub
    JOIN categoria cat ON sub.CategoriaSubcategoria = cat.IDCategoria";

    $objeto_subcategorias = $db->Execute($sql);
    $todas_subcategorias = [];
    if($objeto_subcategorias -> RecordCount() > 0){
        while (!$objeto_subcategorias -> EOF){
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
    return $todas_subcategorias;

}

function todas_subcategoriasPag($start, $limit) : array{
    global $db;

    $sql = "SELECT * FROM subcategoria sub
    JOIN categoria cat ON sub.CategoriaSubcategoria = cat.IDCategoria
    LIMIT " . $start . ", " . $limit;

    $objeto_subcategorias = $db->Execute($sql);
    $todas_subcategorias = [];
    if($objeto_subcategorias -> RecordCount() > 0){
        while (!$objeto_subcategorias -> EOF){
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
    return $todas_subcategorias;

}



function todos_productos ($start, $limit){
    global $db;

    $sql = "SELECT * FROM producto pr JOIN subcategoria s ON pr.SubcategoriaProducto = s.IDSubcategoria
            LIMIT " . $start . ", " . $limit;
    $objeto_productos = $db->Execute($sql);
    $todos_productos = [];
    if($objeto_productos -> RecordCount() > 0){
        while (!$objeto_productos ->EOF){
            $IDProducto = $objeto_productos ->fields["IDProducto"];
            $NombreProducto = $objeto_productos ->fields["NombreProducto"];
            $ImagenProducto = $objeto_productos ->fields["ImagenProducto"];
            $NombreSubcategoria = $objeto_productos ->fields["NombreSubcategoria"];
            $todos_productos [] = [
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,
                "NombreSubcategoria" =>  $NombreSubcategoria,
            ];
            $objeto_productos->MoveNext();
        }
        $objeto_productos->Close();
    }
    return $todos_productos;
}

function buscarSubcategoria($buscador, $start, $limit){
    global $db;
    $buscador = mysqli_real_escape_string($db->cnx, $buscador);
    $buscador = strtolower($buscador);

    $sql = "SELECT * FROM Subcategoria sab
            JOIN Categoria cat ON sab.CategoriaSubcategoria = cat.IDCategoria
            WHERE (LOWER(sab.NombreSubcategoria) LIKE '%$buscador%')
            LIMIT " . $start . ", " . $limit;

    $objeto = $db->Execute($sql);
    $resultado = [];
    if($objeto -> RecordCount() > 0){
        while (!$objeto -> EOF){
            $IDSubcategoria = $objeto ->fields["IDSubcategoria"];
            $NombreSubcategoria = $objeto ->fields["NombreSubcategoria"];
            $NombreCategoria = $objeto ->fields["NombreCategoria"];
            $resultado [] = [
                "IDSubcategoria" =>  $IDSubcategoria,
                "NombreSubcategoria" =>  $NombreSubcategoria,
                "NombreCategoria" =>  $NombreCategoria,
            ];

            $objeto->MoveNext();
        }

        $objeto->Close();
    }


    return $resultado;
}




function buscarProducto ($buscador, $start, $limit) {
    global $db;
    $buscador = mysqli_real_escape_string($db->cnx, $buscador);
    $buscador = strtolower($buscador);

    $sql = "SELECT *
            FROM Producto
            JOIN Subcategoria ON Producto.SubcategoriaProducto = Subcategoria.IDSubcategoria
            WHERE (Producto.ActivoProducto = 'Si' AND Subcategoria.ActivoSubcategoria = 'Si')
            AND (LOWER(Producto.NombreProducto) LIKE '%$buscador%' OR LOWER(Subcategoria.NombreSubcategoria) LIKE '%$buscador%')
            LIMIT " . $start . ", " . $limit;


    $objeto = $db->Execute($sql);
    $resultado = [];
    if($objeto -> RecordCount() > 0){
        while (!$objeto ->EOF){
            $IDProducto = $objeto ->fields["IDProducto"];
            $NombreProducto = $objeto ->fields["NombreProducto"];
            $NombreSubcategoria = $objeto ->fields["NombreSubcategoria"];
            $ImgProducto = $objeto ->fields["ImagenProducto"];
            $resultado [] = [

                "IDProducto" => $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "NombreSubcategoria" =>  $NombreSubcategoria,
                "ImagenProducto" => $ImgProducto
            ];


            $objeto->MoveNext();
        }

        $objeto->Close();
    }


    return $resultado;
}




function categorias_subcategorias(){
    global $db;

    $sql = "SELECT * FROM subcategoria sub
            JOIN categoria cat ON sub.CategoriaSubcategoria = cat.IDCategoria ORDER BY IdSubCategoria ASC";

    $objeto_subcategoria = $db->Execute($sql);
    $todas_subcategorias = [];

    if ($objeto_subcategoria->RecordCount() > 1) {
        while (!$objeto_subcategoria->EOF) {
            $IDSubcategoria = $objeto_subcategoria->fields["IDSubcategoria"];
            $NombreSubcategoria = $objeto_subcategoria->fields["NombreSubcategoria"];
            $NombreCategoria = $objeto_subcategoria->fields["NombreCategoria"];
            $CategoriaSubcategoria = $objeto_subcategoria->fields["CategoriaSubcategoria"];

            // Проверяем существование категории без кавычек вокруг переменной
            if (!isset($todas_subcategorias[$CategoriaSubcategoria])) {
                $todas_subcategorias[$CategoriaSubcategoria] = [
                    "IDCategoria" => $CategoriaSubcategoria,
                    "NombreCategoria" => $NombreCategoria,
                    "Subcategorias" => []
                ];
            }

            $todas_subcategorias[$CategoriaSubcategoria]['Subcategorias'][] = [
                "IDSubcategoria" => $IDSubcategoria,
                "NombreSubcategoria" => $NombreSubcategoria,
            ];

            $objeto_subcategoria->MoveNext();
        }
        $objeto_subcategoria->Close();
    }
    return $todas_subcategorias;
}

//función para ver todas opiniones
function todas_opiniones($start, $limit) : array{

    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            LIMIT " . $start . ", " . $limit;

    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}

function todas_opinionesCategoria($IDCategoria, $start, $limit) : array{

    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE cat.IDCategoria = $IDCategoria
            LIMIT " . $start . ", " . $limit;

    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}

function todas_opinionesSubcategoria($IDSubategoria, $start, $limit) : array{

    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE sc.IDSubcategoria = $IDSubategoria
            LIMIT " . $start . ", " . $limit;

    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}


function leerOpinion($IDOpinion) {
    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE o.IDOpinion = $IDOpinion";

    $objeto_opinion = $db->Execute($sql);
    $opinion = [];

    if ($objeto_opinion -> RecordCount() > 0){
        while (!$objeto_opinion -> EOF){
            $IDOpinion = $objeto_opinion ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opinion ->fields["FechaOpinion"];
            $Comentario = $objeto_opinion ->fields["ComentarioOpinion"];
            $Rating = $objeto_opinion ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opinion ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opinion ->fields["IDUsuario"];
            $IDProducto = $objeto_opinion ->fields["IDProducto"];
            $NombreProducto = $objeto_opinion ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opinion ->fields["ImagenProducto"];
            $NombreCategoria = $objeto_opinion ->fields["NombreCategoria"];
            $NombreSubcategoria = $objeto_opinion ->fields["NombreSubcategoria"];
            $opinion [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,
                "NombreCategoria" =>  $NombreCategoria,
                "NombreSubcategoria" =>  $NombreSubcategoria,

            ];
            $objeto_opinion->MoveNext();
        }
        $objeto_opinion->Close();
    }

    return $opinion;
}


function buscasOpinion ($elementoBuscado, $start, $limit) {
    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE (pr.ActivoProducto = 'Si' AND sc.ActivoSubcategoria = 'Si' AND cat.ActivoCategoria = 'Si')
            AND (LOWER(pr.NombreProducto) LIKE '%$elementoBuscado%' OR LOWER(sc.NombreSubcategoria) LIKE '%$elementoBuscado%' OR LOWER(cat.NombreCategoria) LIKE '%$elementoBuscado%')
            LIMIT " . $start . ", " . $limit;


    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}

function ordenarOpinion ($tipo, $start, $limit) : array{
    global $db;

    $sql = '';

    if($tipo == "fecha"){
        $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion 
            ORDER BY o.FechaOpinion DESC 
            LIMIT " . $start . ", " . $limit;
    } if ($tipo == "puntuacion"){
        $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion 
            ORDER BY o.ClasificacionOpinion DESC
            LIMIT " . $start . ", " . $limit;;

    };
    $objeto_opiniones = $db->Execute($sql);

    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}

function ordenarOpinionBuscado($tipo, $elementoBuscado, $start, $limit) : array {
    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE (pr.ActivoProducto = 'Si' AND sc.ActivoSubcategoria = 'Si' AND cat.ActivoCategoria = 'Si')
            AND (LOWER(pr.NombreProducto) LIKE '%$elementoBuscado%' OR LOWER(sc.NombreSubcategoria) LIKE '%$elementoBuscado%' OR LOWER(cat.NombreCategoria) LIKE '%$elementoBuscado%')";



    if ($tipo == "fecha") {
        $sql .= " ORDER BY o.FechaOpinion ASC";
    } elseif ($tipo == "puntuacion") {
        $sql .= " ORDER BY o.ClasificacionOpinion DESC";
    }

    $sql .= " LIMIT " . $start . ", " . $limit;


    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones->RecordCount() > 0) {
        while (!$objeto_opiniones->EOF) {
            $todas_opiniones[] = [
                "IDOpinion" => $objeto_opiniones->fields["IDOpinion"],
                "FechaOpinion" => $objeto_opiniones->fields["FechaOpinion"],
                "ComentarioOpinion" => $objeto_opiniones->fields["ComentarioOpinion"],
                "Rating" => $objeto_opiniones->fields["ClasificacionOpinion"],
                "LoginUsuario" => $objeto_opiniones->fields["LoginUsuario"],
                "IDUsuario" => $objeto_opiniones->fields["IDUsuario"],
                "IDProducto" => $objeto_opiniones->fields["IDProducto"],
                "NombreProducto" => $objeto_opiniones->fields["NombreProducto"],
                "ImagenProducto" => $objeto_opiniones->fields["ImagenProducto"],
            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}


function calcularTotalOpinienesCategoria($IDCategoria)
{
    global $db;

    $sql = "SELECT count(*) as total FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE cat.IDCategoria = " . $IDCategoria;

    $objeto = $db->Execute($sql);

    $array = [];

    if ($objeto-> RecordCount() > 0){
        while (!$objeto -> EOF){
            $total = $objeto->fields["total"];
            $array[] = [
                "total" =>  $total,

            ];
            $objeto->MoveNext();
        }
        $objeto->Close();
    }

    return $array[0]['total'];

}

function calcularTotalOpinienesSubcategoria($IDSubcategoria)
{
    global $db;

    $sql = "SELECT count(*) as total FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            JOIN subcategoria sc ON sc.IDSubcategoria = pr.SubcategoriaProducto
            JOIN categoria cat ON cat.IDCategoria = sc.CategoriaSubcategoria
            WHERE sc.IDSubcategoria = " . $IDSubcategoria;

    $objeto = $db->Execute($sql);

    $array = [];

    if ($objeto-> RecordCount() > 0){
        while (!$objeto -> EOF){
            $total = $objeto->fields["total"];
            $array[] = [
                "total" =>  $total,

            ];
            $objeto->MoveNext();
        }
        $objeto->Close();
    }

    return $array[0]['total'];

}

//Funciones para autorización del usuario
//1. función que revise el estado del usuario
function revisarEstado(string $value = '') : bool {
    $estado = false;

    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if(!empty($_SESSION['login']) && $value==""){
        $estado = true;
    } elseif ($value !== ""){
        if((!empty($_SESSION['login']) || !empty($_SESSION['email'])) && $_SESSION['login'] !== $value && $_SESSION['email'] !== $value) {
            unset($_SESSION['login']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);
        }
    }
    return $estado;
}

function usuarioAutenticado(array $data) : array {
    $resultado = [
        'success' => FALSE,
        'message' => "Error inicial",
        'data' => [],
        'type' => 'auth'
    ];

    if (empty($data['login']) || empty($data['password'])) {
        $resultado['message'] = "Es necesario ingresar login y contraseña";
        return $resultado;
    }

    $sLogin = htmlspecialchars(trim($data['login']));
    $sPassword = htmlspecialchars(trim($data['password']));
    $sType = validarEmail($sLogin) ? 'EmailUsuario' : 'LoginUsuario';

    global $db;

    $sql = "SELECT * FROM usuario WHERE $sType = '$sLogin'";
    $objeto_usuarios = $db->Execute($sql);

    if ($objeto_usuarios->RecordCount() > 0) {
        while (!$objeto_usuarios->EOF) {
            $Password = $objeto_usuarios -> fields["PasswordUsuario"];
            if (isset($Password) && password_verify($sPassword, $Password)) {
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }

                $_SESSION['login'] = $objeto_usuarios->fields["LoginUsuario"];
                $_SESSION['email'] = $objeto_usuarios->fields["EmailUsuario"];
                $_SESSION['user_id'] = $objeto_usuarios->fields["IDUsuario"];

                $resultado['success'] = TRUE;
                $resultado['message'] = "Usted está autenticado";
                $resultado['data'] = $data;
            } else {
                $resultado['message'] = "La contraseña no es correcta para el usuario proporcionado";

            }

            $objeto_usuarios->MoveNext();
        }
        $objeto_usuarios->Close();
    }  else {
    $resultado['message'] = "No se encontró el usuario";
    }

    //$db->Close();
    return $resultado;
}

function usuarioRegistrado(array $data) : array {
    $resultado = [
        'success' => FALSE,
        'message' => "Ha pasado error",
        'data' => [],
        'type' => 'reg'
    ];

    if (empty($data['login']) || empty($data['email']) || empty($data['password']) || empty($data['password2'])) {
        $resultado['message'] = "Todos los campos son obligatorios";
        return $resultado;
    }

    $sLogin = htmlspecialchars(trim($data['login']));
    $sEmail = htmlspecialchars(trim($data['email']));
    $sPassword = htmlspecialchars(trim($data['password']));
    $sPassword2 = htmlspecialchars(trim($data['password2']));

    // Проверка валидности email
    if (!validarEmail($sEmail)) {
        $resultado['message'] = "El correo electrónico no es válido";
        return $resultado;
    }

    // Проверка совпадения паролей
    if ($sPassword !== $sPassword2) {
        $resultado['message'] = "Las contraseñas no coinciden";
        return $resultado;
    }

    global $db;
    $db->Connect();

    // Проверка уникальности логина и email
    if (isLoginExist($sLogin)) {
        $resultado['message'] = "Este login ya existe";
        return $resultado;
    }
    if (isEmailExist($sEmail)) {
        $resultado['message'] = "Este email ya existe";
        return $resultado;
    }

    // Хеширование пароля перед сохранением
    $sPasswordHash = password_hash($sPassword, PASSWORD_BCRYPT);

    // Вставка данных в базу
    $sql = "INSERT INTO usuario (FechaAltaUsuario, LoginUsuario, EmailUsuario, PasswordUsuario) VALUES (now(), '$sLogin', '$sEmail', '$sPasswordHash')";
    $objeto_usuarios = $db->Execute($sql);

    // Проверяем, был ли пользователь успешно добавлен
    $ultimoId = mysqli_insert_id($db->cnx);
    if ($ultimoId) {
        $resultado['success'] = TRUE;
        $resultado['message'] = "El usuario con <strong>{$sLogin}</strong> y el correo <strong>{$sEmail}</strong> está registrado.";
        $resultado['data']['user_id'] = mysqli_insert_id($db->cnx);
        $_SESSION['user_id'] = $ultimoId; // Сохранение user_id в сессию
    } else {
        $resultado['message'] = "Hubo un error al registrar el usuario";
    }

    //$db->Close();
    return $resultado;
}
function validarEmail(string $email) : bool{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isLoginExist($login) {
    global $db;
    // Добавляем кавычки вокруг значения $login, чтобы предотвратить интерпретацию его как название столбца
    $login = mysqli_real_escape_string($db->cnx, $login); // Это также помогает предотвратить SQL-инъекции
    $sql = "SELECT 1 FROM usuario WHERE LoginUsuario = '$login'";
    $result = $db->Execute($sql);
    return $result->RecordCount() > 0;
}

function isEmailExist($email) {
    global $db;
    // Аналогично, добавляем кавычки вокруг значения $email
    $email = mysqli_real_escape_string($db->cnx, $email); // Это также помогает предотвратить SQL-инъекции
    $sql = "SELECT 1 FROM usuario WHERE EmailUsuario = '$email'";
    $result = $db->Execute($sql);
    return $result->RecordCount() > 0;
}

function usuarioDatos(){
    $return = NULL;

    if (revisarEstado())
    {
        $return['login'] = $_SESSION['login'];
        $return['email'] = $_SESSION['email'];
    }

    return $return;
}

function usuarioLogout()
{
    if (session_status() !== PHP_SESSION_ACTIVE)
    {
        session_start();
    }

    unset($_SESSION['login']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['user_id']);
}

//para la pagina del inicio
function opinionesInicioFecha1(){
    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            ORDER BY FechaOpinion DESC
            LIMIT 8
            ";

    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}

function opinionesInicioRating(){
    global $db;

    $sql = "SELECT * FROM opinion o
            JOIN producto pr ON pr.IDProducto = o.ProductoOpinion
            JOIN usuario u ON u.IDUsuario = o.UsuarioOpinion
            ORDER BY ClasificacionOpinion DESC
            LIMIT 8
            ";

    $objeto_opiniones = $db->Execute($sql);
    $todas_opiniones = [];

    if ($objeto_opiniones -> RecordCount() > 0){
        while (!$objeto_opiniones -> EOF){
            $IDOpinion = $objeto_opiniones ->fields["IDOpinion"];
            $FechaOpinion = $objeto_opiniones ->fields["FechaOpinion"];
            $Comentario = $objeto_opiniones ->fields["ComentarioOpinion"];
            $Rating = $objeto_opiniones ->fields["ClasificacionOpinion"];
            $LoginUsuario = $objeto_opiniones ->fields["LoginUsuario"];
            $IDUsuario = $objeto_opiniones ->fields["IDUsuario"];
            $IDProducto = $objeto_opiniones ->fields["IDProducto"];
            $NombreProducto = $objeto_opiniones ->fields["NombreProducto"];
            $ImagenProducto = $objeto_opiniones ->fields["ImagenProducto"];
            $todas_opiniones [] = [
                "IDOpinion" =>  $IDOpinion,
                "FechaOpinion" =>  $FechaOpinion,
                "ComentarioOpinion" =>  $Comentario,
                "Rating" =>  $Rating,
                "LoginUsuario" =>  $LoginUsuario,
                "IDUsuario" =>  $IDUsuario,
                "IDProducto" =>  $IDProducto,
                "NombreProducto" =>  $NombreProducto,
                "ImagenProducto" =>  $ImagenProducto,

            ];
            $objeto_opiniones->MoveNext();
        }
        $objeto_opiniones->Close();
    }

    return $todas_opiniones;
}
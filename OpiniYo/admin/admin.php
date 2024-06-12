<?php
include '../func.php';
session_start();

$_SESSION['error'] = false;
if(isset($_POST['submit'])){
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    global $db;

    $sql = "SELECT * FROM admin WHERE EmailAdmin = '$email' AND PasswordAdmin = '$password'";

    $datos = $db->Execute($sql);

    if($datos->RecordCount()>0){
        $LoginAdmin = $datos->fields["LoginAdmin"];
        $_SESSION['loginAdmin'] = $LoginAdmin;
        header('Location: categorias/index.php');
        exit();
    } else {
        $_SESSION['error'] = true;
        header('Location: index.php');
        exit();

    }

}


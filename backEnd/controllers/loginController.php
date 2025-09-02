<?php
require "../config/dataBaseConfig.php"; // Importar la conexión a la base de datos
require "../model/login.php"; // Importar el modelo de Login

$loginModel = new Login($pdo); // Crear una instancia del modelo de Login

function autenticarUsuario($nombre, $password)
{
    global $loginModel;
    echo json_encode($loginModel->autenticar($nombre, $password));
}

function agregarUsuario($nombre, $password)
{
    global $loginModel;
    echo json_encode($loginModel->agregar($nombre, $password));
}
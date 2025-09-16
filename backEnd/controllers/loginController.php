<?php
require "../model/login.php"; // Importar el modelo de Login

$loginModel = new Login($pdo); // Crear una instancia del modelo de Login

function autenticarUsuario($username, $password)
{
    global $loginModel;
    return $loginModel->autenticar($username, $password);
}
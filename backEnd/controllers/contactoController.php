<?php
require_once '../model/contacto.php';

$contactoModel = new Contacto($pdo);

function agregarContacto($nombre, $email, $asunto, $mensaje){
    global $contactoModel;
    return $contactoModel->agregarContacto($nombre, $email, $asunto, $mensaje);
}

function obtenerContactos(){
    global $contactoModel;
    return $contactoModel->obtenerTodos();
}
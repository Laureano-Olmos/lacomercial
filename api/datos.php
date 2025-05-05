<?php
//requiere el archivo modelos.php
require_once 'modelos.php';

//si hay en parametro tabla
if(isset($_GET['tabla'])) { //si esta seteado el parametro tabla
    $tabla = new Modelo($_GET['tabla']); //creamos el objeto tabla

    //si hay parametro id
    if(isset($_GET['id'])) {
        $tabla->setCriterio("id=" . $_GET['id']);
    }

    $datos = $tabla->seleccionar(); //ejecutamos el metodo seleccionar
    echo $datos; //mostramos los datos
}
?>
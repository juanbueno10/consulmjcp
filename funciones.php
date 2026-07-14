<?php
    function conexion(){
        $host="localhost";
        $usuario="root";
        $clave="";
        $bd="consultorio_medico";
        /*Crear una variable que combine los parámetros
        de conexión antes creados más la función de la 
        conexión a la base de datos*/
        $con=mysqli_connect($host,$usuario,$clave,$bd) or die ("Error al conectar con la base de datos");
        //Retornar el valor de la variable de conexión
        return $con;
    }

?>
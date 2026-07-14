
<?php
/*
Motivos de la Consulta
Signos Vitales
Examen Físico
Examenes Complementarios
Diagnóstico
Tratamiento


*/
session_start();

// Verificar que el usuario haya iniciado sesión
if(!isset($_SESSION['autenticado'])){
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Consulta Médica</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}

body{
    background:linear-gradient(135deg,#0F4C81,#4DA8DA);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Barra superior */
.barra-superior{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:60px;
    background:#0F4C81;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
    box-shadow:0 3px 10px rgba(0,0,0,.3);
}

.usuario{
    font-size:17px;
    font-weight:bold;
}

.cerrar a{
    color:white;
    text-decoration:none;
    background:#d32f2f;
    padding:8px 15px;
    border-radius:8px;
    transition:.3s;
}

.cerrar a:hover{
    background:#b71c1c;
}

#Menu{
    width:430px;
    background:#fff;
    padding:35px;
    border-radius:18px;
    box-shadow:0 15px 35px rgba(0,0,0,.25);
}

table{
    width:100%;
    border-spacing:18px;
}

th{
    text-align:center;
}

.titulo{
    font-size:28px;
    color:#0F4C81;
    padding-bottom:15px;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:linear-gradient(90deg,#1976D2,#42A5F5);
    color:white;
    font-size:17px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
    box-shadow:0 5px 15px rgba(25,118,210,.3);
}

button:hover{
    background:linear-gradient(90deg,#1565C0,#1E88E5);
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,.25);
}

button:active{
    transform:scale(.98);
}

</style>

</head>

<body>

<!-- Barra superior -->
<div class="barra-superior">

    <div class="usuario">
        👤 Bienvenido: <strong><?php echo htmlspecialchars($usuario); ?></strong>
    </div>

    <div class="cerrar">
        <a href="cerrar.php">Cerrar sesión</a>
    </div>

</div>

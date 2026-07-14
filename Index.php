<?php
$mensaje = "";

if(isset($_POST['ingresar'])){
    session_start();

    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    include("funciones.php");
    $con = conexion();

    $consulta = "SELECT * FROM login WHERE usuario='$usuario' AND clave='$pass'";
    $ejecutar_consulta = mysqli_query($con,$consulta);

    if(mysqli_num_rows($ejecutar_consulta) >= 1){

        $_SESSION['usuario'] = $usuario;
        $_SESSION['autenticado'] = true;

        header("Location: Principal.php");
        exit();

    }else{
        $mensaje = "❌ Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Logueo</title>

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

.contenedor{
    display:flex;
    flex-direction:column;
    align-items:center;
}

#loguin{
    width:380px;
    padding:35px;
    background:#fff;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.25);
}

table{
    width:100%;
    border-spacing:12px;
}

th[colspan="2"]{
    font-size:28px;
    color:#0F4C81;
    padding-bottom:15px;
}

th{
    text-align:left;
    color:#333;
    font-weight:600;
}

td{
    width:100%;
}

input[type=text],
input[type=password]{
    width:100%;
    padding:12px;
    border:1px solid #cfd8dc;
    border-radius:8px;
    font-size:15px;
    outline:none;
    transition:.3s;
}

input[type=text]:focus,
input[type=password]:focus{
    border-color:#4DA8DA;
    box-shadow:0 0 8px rgba(77,168,218,.4);
}

input[type=submit]{
    width:100%;
    padding:12px;
    background:#0F4C81;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

input[type=submit]:hover{
    background:#1565C0;
    transform:translateY(-2px);
    box-shadow:0 5px 15px rgba(0,0,0,.2);
}

.mensaje-error{
    width:380px;
    margin-top:20px;
    background:#ffebee;
    color:#c62828;
    border:1px solid #ef9a9a;
    border-radius:8px;
    padding:12px;
    text-align:center;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="contenedor">

<section id="loguin">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<table>
<tr>
    <th colspan="2" style="text-align:center;">
        <img src="./imagenes/Logo Login.png" width="100%"alt="Consultorio Médico">
    </th>
</tr>
<tr>
    <th colspan="2" style="text-align:center;">
        Sistema de Logueo
    </th>
</tr>

<tr>
    <th>Usuario:</th>
    <td>
        <input type="text" name="usuario" placeholder="Nombre de Usuario" required>
    </td>
</tr>

<tr>
    <th>Contraseña:</th>
    <td>
        <input type="password" name="pass" placeholder="Contraseña" required>
    </td>
</tr>

<tr>
    <th colspan="2">
        <input type="submit" name="ingresar" value="Ingresar">
    </th>
</tr>

</table>

</form>

</section>

<?php
if($mensaje != ""){
    echo "<div class='mensaje-error'>$mensaje</div>";
}
?>

</div>

</body>
</html>
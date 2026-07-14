<?php
session_start();
if(!isset($_SESSION['autenticado'])){
    header("Location: index.php");
    exit();
}
$usuario=$_SESSION['usuario'];


$mensaje = "";
$clase = "";
if (isset($_POST['guardar'])) {

    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $barrio = $_POST['barrio'];
    $canton = $_POST['canton'];
    $provincia = $_POST['provincia'];
    $celular = $_POST['celular'];
    $nacimiento = $_POST['nacimiento'];
    $lugar= $_POST['lugar'];
    $genero = $_POST['genero'];
    $discapacidad = $_POST['discapacidad'];
    $tipo_discapacidad = $_POST['tipo_discapacidad'];
    $estado_civil = $_POST['estado_civil'];
    $tipo_sangre = $_POST['tipo_sangre'];
    //tabla antecedentes
    $alergias=$_POST['alergias'];
    $clinico=$_POST['clinico'];
    $ginecologico=$_POST['ginecologico'];
    $traumatologico=$_POST['traumatologico'];
    $quirurgico=$_POST['quirurgico'];
    $farmacologico=$_POST['farmacologico'];
     //tabla enfermedad actual
    $enfermedad_actual=$_POST['descripcion'];


    include("funciones.php");

    $con = conexion();

    $consulta = "SELECT * FROM pacientes WHERE cedula='$cedula'";

    $ejecutar_consulta = mysqli_query($con, $consulta);

    if (mysqli_num_rows($ejecutar_consulta) == 0) {
        //Código de Insertar aquí 

       //Insertar tabla pacientes 
       $insertar_paciente="insert into pacientes values('$cedula','$nombre', '$apellido','$direccion', '$barrio','$canton','$provincia','$celular','$nacimiento','$lugar','$genero','$discapacidad','$tipo_discapacidad','$estado_civil','$tipo_sangre')";
       
       //Insertar tabla antecedentes
        $insertar_antecedentes="insert into antecedentes values(null,'$cedula','$alergias','$clinico','$ginecologico','$traumatologico','$quirurgico','$farmacologico')";
        
        
        //Insertar tabla enfermedad actual
        $insertar_enfermedad="insert into enfermedad_actual values (null,'$cedula','$enfermedad_actual')";
        //ejecutar insertar
        $ejecutar_insertar_paciente=mysqli_query($con,$insertar_paciente);
        $ejecutar_insertar_antecedentes=mysqli_query($con,$insertar_antecedentes);
        $ejecutar_insertar_enfermedad=mysqli_query($con,$insertar_enfermedad);
            if($ejecutar_insertar_paciente && $ejecutar_insertar_antecedentes && $ejecutar_insertar_enfermedad
            ){
                $mensaje="Paciente registrado correctamente.";
                $clase="exito";
            }else{
                $mensaje=mysqli_error($con);
                $clase="error";
            }

    } else {
        $mensaje = "El paciente ya existe en la base de datos.";
        $clase = "error";
    }

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nuevo Paciente</title>
<style>

/*====================================
            ESTILOS GENERALES
====================================*/

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI",Tahoma,Geneva,Verdana,sans-serif;
}

body{

    background:linear-gradient(135deg,#0F4C81,#4DA8DA);

    padding:90px 20px;

}

/*====================================
          BARRA SUPERIOR
====================================*/

.barra-superior{

    position:fixed;

    top:0;
    left:0;

    width:100%;

    height:65px;

    background:#0F4C81;

    color:white;

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:0 25px;

    box-shadow:0 3px 10px rgba(0,0,0,.25);

}

.cerrar a{

    background:#c62828;

    color:white;

    text-decoration:none;

    padding:10px 16px;

    border-radius:8px;

    transition:.3s;

}

.cerrar a:hover{

    background:#b71c1c;

}

/*====================================
          CONTENEDOR
====================================*/

#Menu{

    max-width:1100px;

    margin:auto;

    background:white;

    padding:35px;

    border-radius:15px;

    box-shadow:0 15px 35px rgba(0,0,0,.25);

}

h1{

    color:#0F4C81;

    text-align:center;

    margin-bottom:25px;

}

/*====================================
          FORMULARIO
====================================*/

form{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:25px;

}

/*====================================
          FIELDSET
====================================*/

fieldset{

    border:2px solid #4DA8DA;

    border-radius:10px;

    padding:20px;

}

fieldset:last-of-type{

    grid-column:1/3;

}

legend{

    color:#0F4C81;

    font-weight:bold;

    font-size:18px;

    padding:0 10px;

}

/*====================================
          LABELS
====================================*/

label{

    display:block;

    margin-top:12px;

    margin-bottom:5px;

    font-weight:bold;

    color:#333;

}

/*====================================
          INPUTS
====================================*/

input[type=text],
input[type=date],
select,
textarea{

    width:100%;

    padding:10px;

    border:1px solid #ccc;

    border-radius:7px;

    font-size:15px;

}

input:focus,
select:focus,
textarea:focus{

    outline:none;

    border-color:#1976D2;

    box-shadow:0 0 8px rgba(25,118,210,.3);

}

textarea{

    resize:vertical;

    min-height:90px;

}

/*====================================
        RADIO BUTTONS
====================================*/

.grupo-radio{

    display:flex;

    flex-wrap:wrap;

    align-items:center;

    gap:15px;

    margin-top:8px;

}

.grupo-radio input[type=radio]{

    width:auto;

    margin:0;

}

.grupo-radio label{

    display:inline;

    margin:0;

    font-weight:normal;

}

/*====================================
          BOTÓN
====================================*/

.full{

    grid-column:1/3;

}

button{

    width:100%;

    padding:15px;

    border:none;

    border-radius:8px;

    background:#1976D2;

    color:white;

    font-size:18px;

    cursor:pointer;

    transition:.3s;

}

button:hover{

    background:#1565C0;

}

/*====================================
     MENSAJE VALIDACIÓN CÉDULA
====================================*/

#mensajeCedula{

    display:block;

    margin-top:5px;

    font-size:14px;

    font-weight:bold;

}

/*====================================
      MENSAJES PHP
====================================*/

.mensaje{

    grid-column:1/3;

    margin-top:20px;

    padding:15px;

    border-radius:8px;

    font-weight:bold;

    text-align:center;

}

.exito{

    background:#d4edda;

    color:#155724;

    border:1px solid #28a745;

}

.error{

    background:#f8d7da;

    color:#721c24;

    border:1px solid #dc3545;

}

/*====================================
        RESPONSIVE
====================================*/

@media(max-width:900px){

form{

    grid-template-columns:1fr;

}

fieldset:last-of-type,
.full,
.mensaje{

    grid-column:1;

}

}

</style>

</head>

<body>

    <!--==============================
            BARRA SUPERIOR
    ==============================-->

    <div class="barra-superior">

        <div>
            👤 Bienvenido:
            <strong><?php echo htmlspecialchars($usuario); ?></strong>
        </div>

        <div class="cerrar">
            <a href="cerrar.php">Cerrar sesión</a>
        </div>

    </div>

    <!--==============================
            CONTENEDOR
    ==============================-->

    <div id="Menu">

        <h1>Nuevo Paciente</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <!--==============================
                DATOS DEL PACIENTE
            ==============================-->

            <fieldset>

                <legend>Datos del Paciente</legend>

                <label for="cedula">Cédula</label>
                <input type="text"
                       id="cedula"
                       name="cedula"
                       maxlength="10"
                       required>

                <span id="mensajeCedula"></span>

                <label for="nombre">Nombres</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellidos</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion">

                <label for="barrio">Barrio</label>
                <input type="text" id="barrio" name="barrio">

                <label for="canton">Cantón</label>
                <input type="text" id="canton" name="canton">

                <label for="provincia">Provincia</label>
                <input type="text" id="provincia" name="provincia">

                <label for="celular">Celular</label>
                <input type="text" id="celular" name="celular">

                <label for="nacimiento">Fecha de nacimiento</label>
                <input type="date" id="nacimiento" name="nacimiento">
                
                <label for="lugar">Lugar de Nacimiento</label>
                <input type="text" id="lugar" name="lugar">
                
                <label>Género</label>

                <div class="grupo-radio">

                    <input type="radio" id="masculino" name="genero" value="Masculino" required>
                    <label for="masculino">Masculino</label>

                    <input type="radio" id="femenino" name="genero" value="Femenino">
                    <label for="femenino">Femenino</label>

                    <input type="radio" id="otro" name="genero" value="Otro">
                    <label for="otro">Otro</label>

                </div>

                <label>¿Posee discapacidad?</label>

                <div class="grupo-radio">

                    <input type="radio" id="si" name="discapacidad" value="Sí" required>
                    <label for="si">Sí</label>

                    <input type="radio" id="no" name="discapacidad" value="No">
                    <label for="no">No</label>

                </div>

                <label for="tipo_discapacidad">Tipo de discapacidad</label>

                <select id="tipo_discapacidad" name="tipo_discapacidad">

                    <option value="">Seleccione</option>
                    <option>Física</option>
                    <option>Visual</option>
                    <option>Auditiva</option>
                    <option>Intelectual</option>
                    <option>Psicosocial</option>
                    <option>Múltiple</option>
                    <option>Otra</option>

                </select>

                <label for="estado_civil">Estado civil</label>

                <select id="estado_civil" name="estado_civil">

                    <option>Soltero/a</option>
                    <option>Casado/a</option>
                    <option>Unión de hecho</option>
                    <option>Divorciado/a</option>
                    <option>Separado/a</option>
                    <option>Viudo/a</option>

                </select>

                <label for="tipo_sangre">Tipo de sangre</label>

                <select id="tipo_sangre" name="tipo_sangre">

                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                    <option>No sabe</option>

                </select>

            </fieldset>

            <!--==============================
                ANTECEDENTES
            ==============================-->

            <fieldset>

                <legend>Antecedentes</legend>

                <label for="alergias">Alergias</label>
                <textarea id="alergias" name="alergias"></textarea>

                <label for="clinico">Antecedentes Clínicos</label>
                <textarea id="clinico" name="clinico"></textarea>

                <label for="ginecologico">Antecedentes Ginecológicos</label>
                <textarea id="ginecologico" name="ginecologico"></textarea>

                <label for="traumatologico">Antecedentes Traumatológicos</label>
                <textarea id="traumatologico" name="traumatologico"></textarea>

                <label for="quirurgico">Antecedentes Quirúrgicos</label>
                <textarea id="quirurgico" name="quirurgico"></textarea>

                <label for="farmacologico">Antecedentes Farmacológicos</label>
                <textarea id="farmacologico" name="farmacologico"></textarea>

            </fieldset>

            <!--==============================
                ENFERMEDAD ACTUAL
            ==============================-->

            <fieldset>

                <legend>Enfermedad Actual</legend>

                <label for="descripcion">
                    Descripción
                </label>

                <textarea id="descripcion"
                          name="descripcion"></textarea>

            </fieldset>

            <div class="full">

                <button type="submit" name="guardar">
                    Guardar Historia Clínica
                </button>

            </div>
<?php
if(!empty($mensaje)){
?>
    <div class="mensaje <?php echo $clase; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php
}
?>
        </form>

    </div>

    <!--==============================
        VALIDACIÓN DE CÉDULA
    ==============================-->

    <script>

        const cedula = document.getElementById("cedula");
        const mensaje = document.getElementById("mensajeCedula");

        cedula.addEventListener("input", function () {

            this.value = this.value.replace(/\D/g, '');

            if (this.value.length == 10) {

                if (validarCedula(this.value)) {

                    mensaje.innerHTML = "✅ Cédula válida";
                    mensaje.style.color = "green";

                } else {

                    mensaje.innerHTML = "❌ La cédula ingresada no es válida";
                    mensaje.style.color = "red";

                }

            } else {

                mensaje.innerHTML = "";

            }

        });


        function validarCedula(cedula) {

            if (cedula.length != 10)
                return false;

            let provincia = parseInt(cedula.substring(0, 2));

            if (provincia < 1 || provincia > 24)
                return false;

            let tercer = parseInt(cedula.charAt(2));

            if (tercer >= 6)
                return false;

            let suma = 0;

            for (let i = 0; i < 9; i++) {

                let numero = parseInt(cedula.charAt(i));

                if (i % 2 == 0) {

                    numero *= 2;

                    if (numero > 9)
                        numero -= 9;

                }

                suma += numero;

            }

            let decena = Math.ceil(suma / 10) * 10;
            let verificador = decena - suma;

            if (verificador == 10)
                verificador = 0;

            return verificador == parseInt(cedula.charAt(9));

        }

    </script>

<?php


?>
</body>

</html>
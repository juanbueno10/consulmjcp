
DROP DATABASE IF EXISTS consultorio_medico;
CREATE DATABASE consultorio_medico;
USE consultorio_medico;

-- LOGIN
CREATE TABLE login (
    id_login INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    clave VARCHAR(255) NOT NULL
);

-- 1. DATOS DE FILIACIÓN
CREATE TABLE pacientes (
    cedula char(10) PRIMARY KEY,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    direccion VARCHAR(200),
    barrio VARCHAR(100),
    canton VARCHAR(100),
    provincia VARCHAR(100),
    celular VARCHAR(10),
    fecha_nacimiento DATE,
    lugar_nacimiento VARCHAR(100),
    genero VARCHAR(20),
    discapacidad VARCHAR(10),
    tipo_discapacidad VARCHAR(100),
    estado_civil VARCHAR(20),
    tipo_sangre VARCHAR(10)
);

-- 2. MOTIVO DE CONSULTA
CREATE TABLE motivo_consulta (
    id_motivo INT AUTO_INCREMENT PRIMARY KEY,
    fecha date,
    cedula_paciente char(10) not null,
    motivo TEXT,
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 3. ANTECEDENTES FAMILIARES Y PERSONALES
CREATE TABLE antecedentes (
    id_antecedente INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null,
    alergias TEXT,
    clinico TEXT,
    ginecologico TEXT,
    traumatologico TEXT,
    quirurgico TEXT,
    farmacologico TEXT,
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 4. ENFERMEDAD ACTUAL
CREATE TABLE enfermedad_actual (
    id_enfermedad INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null, 
    descripcion TEXT,
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 5. SIGNOS VITALES
CREATE TABLE signos_vitales (
    id_signos INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null,
    pa VARCHAR(20),
    peso DECIMAL(5,2),
    talla DECIMAL(5,2),
    imc DECIMAL(5,2),
    fc INT,
    fr INT,
    temperatura DECIMAL(4,2),
    saturacion_o2 DECIMAL(5,2),
    glasgow_ocular INT,
    glasgow_verbal INT,
    glasgow_motora INT,
    glasgow_total INT,
    llenado_capilar VARCHAR(50),
    reaccion_pupilar VARCHAR(50),
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 6. EXAMEN FÍSICO
CREATE TABLE examen_fisico (
    id_examen INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null, 
    piel_faneras VARCHAR(100),
    cabeza VARCHAR(100),
    cuello VARCHAR(100),
    torax VARCHAR(100),
    corazon VARCHAR(100),
    abdomen VARCHAR(100),
    region_inguinal VARCHAR(100),
    miembros_superiores VARCHAR(100),
    miembros_inferiores VARCHAR(100),
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 7. EMERGENCIAS OBSTÉTRICAS
CREATE TABLE emergencias_obstetricas (
    id_obstetricia INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null, 
    menarca VARCHAR(20),
    ritmo_menstrual VARCHAR(50),
    ciclos VARCHAR(50),
    fum DATE,
    ivsa VARCHAR(50),
    numero_parejas INT,
    gestas INT,
    abortos INT,
    partos INT,
    cesareas INT,
    dismenorrea VARCHAR(10),
    mastodinia VARCHAR(10),
    fpp DATE,
    semanas_gestacion INT,
    controles VARCHAR(100),
    inmunizaciones VARCHAR(100),
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 8. EXÁMENES COMPLEMENTARIOS
CREATE TABLE examenes_complementarios (
    id_examen INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null,
    descripcion TEXT,
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 9. DIAGNÓSTICO
CREATE TABLE diagnostico (
    id_diagnostico INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null,
    diagnostico_inicial TEXT,
    cie10 VARCHAR(20),
    presuntivo TEXT,
    definitivo TEXT,
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- 10. TRATAMIENTO
CREATE TABLE tratamiento (
    id_tratamiento INT AUTO_INCREMENT PRIMARY KEY,
    cedula_paciente char(10) not null,
    tratamiento TEXT,
    FOREIGN KEY (cedula_paciente) REFERENCES pacientes(cedula)
);

-- USUARIO INICIAL
INSERT INTO login (usuario, clave)
VALUES ('james', 'james');
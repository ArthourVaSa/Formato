<?php 

require_once('conexion.php');

$mysql = new connection();
$conexion = $mysql->get_connection();

if(empty($_POST['enviar'])){

    //Cargando datos de la persona
    $nombre = $_POST['name'];
    $apellido = $_POST['apellido'];
    $especialidad = $_POST['especialidad'];
    $anio_ingreso = $_POST['anio_ingreso'];
    $anio_egreso = $_POST['anio_egreso'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $estado_civil = $_POST['estado_civil'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $distrito = $_POST['distrito'];
    $telefono_casa = $_POST['telefono_casa'];
    $telefono_celular = $_POST['telefono_celular'];
    //Cargado de Imagen
    $revisar = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($revisar !== false){
        $imagen = $_FILES['imagen']['tmp_name'];
        $imagenCargada = addslashes(file_get_contents($imagen));
    }else{
        print_r('algo anda mal en la imagen');
    }
    //Cargando datos del Padre de la Persona
    if(!empty($_POST['nombre-padre'])){
        $nombre_padre = $_POST['nombre-padre'];
        $apellido_padre = $_POST['apellido-padre'];
        $ocupacion_padre = $_POST['ocupacion-padre'];
    }else{
        $nombre_padre = "0";
        $apellido_padre = "0";
        $ocupacion_padre = "0";
    }
    //Cargando datos de la Madre de la Persona
    if(!empty($_POST['nombre-madre'])){
        $nombre_madre = $_POST['nombre-madre'];
        $apellido_madre = $_POST['apellido-madre'];
        $ocupacion_madre = $_POST['ocupacion-madre'];
    }else{
        $nombre_madre = "0";
        $apellido_madre = "0";
        $ocupacion_madre = "0";
    }
    //Cargando datos de la Esposa/o de la Persona
    if(!empty($_POST['nombre-esposoa'])){
        $nombre_esposoa = $_POST['nombre-esposoa'];
        $apellido_esposoa = $_POST['ocupacion-esposoa'];
        $ocupacion_esposoa = $_POST['ocupacion-esposoa'];
        $telefono_esposoa = $_POST['teleono-casa-esposoa'];
        $celular_esposoa = $_POST['celular-esposoa'];
    }else{
        $nombre_esposoa = "0";
        $apellido_esposoa = "0";
        $ocupacion_esposoa = "0";
        $telefono_esposoa = "0";
        $celular_esposoa = "0";
    }

    $statement = $conexion->prepare("CALL insertar_persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $statement->bind_param("sssssssssssssssssssssssss",$nombre,$apellido,$especialidad,$anio_ingreso,$anio_egreso,$fecha_nacimiento,$estado_civil,$dni,$correo,$direccion,$distrito,$telefono_casa,$telefono_celular,$nombre_padre,$apellido_padre,$ocupacion_padre,$nombre_madre,$apellido_madre,$ocupacion_madre,$nombre_esposoa,$apellido_esposoa,$ocupacion_esposoa,$telefono_esposoa,$celular_esposoa,$imagenCargada);
    $statement->execute();
    if($statement->error){
        print_r('es este error');
        print($statement->error);
        // header('Location: http://localhost:8080/proyectos/Formato/');
    } else{
    $statement->close();
    header('Location: http://localhost:8080/proyectos/Formato/index.php');
    }
    $conexion->close();    

}else{
    print('Algo anda mal');
    // header('Location: http://localhost:8080/proyectos/Formato/');
}

?>
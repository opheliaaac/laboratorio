<?php
$server = "localhost";
$usuario = "root";
$passwd = "";
$nombreBD = "laboratorio";
$conexion = new mysqli($server, $usuario, $passwd);

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

mysqli_select_db($conexion, $nombreBD);
if (
    isset($_POST["nombre"], $_POST["apellido_1"], $_POST["apellido_2"], $_POST["email"], $_POST["login"], $_POST["pass"])
    and $_POST["nombre"] != ""
    and $_POST["apellido_1"] != ""
    and $_POST["apellido_2"] != ""
    and $_POST["email"] != ""
    and $_POST["login"] != ""
    and $_POST["pass"] != ""
) {
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido_1"];
    $apellido2 = $_POST["apellido_2"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $pass = $_POST["pass"];
    $consulta = "INSERT INTO usuario (nombre, primerApellido, segundoApellido, email, login, password) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$pass')"; //el id se auto-incrementa, por eso no hay que incluirlo
    if (emailExiste($conexion, $email)) {
        echo "<script>alert('Error al completar el registro: El email ya se encuentra registrado.');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        if (mysqli_query($conexion, $consulta)) {
            registroCompletado();
        } else {
            echo "<script>alert('Error al completar el registro');</script>";
            echo "<script>window.history.back();</script>";
        }
    }
}
$conexion->close();

function emailExiste($conexion, $email){
    $consulta = $conexion->prepare("SELECT * FROM usuario WHERE email=?");
    $consulta->execute([$email]);
    $user = $consulta->fetch();
    if ($user) {
        return true;
    } else {
        return false;
    }
}

function registroCompletado(){
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Registro completado</title>
        <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@300;600&family=Roboto:wght@300&display=swap'
            rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet'
            integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
        <link rel='stylesheet' type='text/css' href='estilos.css'>
    </head>
    
    <body class='fondo'>
        <form class='formulario container form-control py-4 shadow' action='consultaUsuarios.php'>
            <h1 class='text-center mt-2'>Registro completado</h1>
            <div class='d-flex flex-column align-items-center'>
                <button type='submit' class='btn boton my-3 text-white'>Consulta Usuarios</button>
            </div>
        </form>
    </body>
    </html>";
}

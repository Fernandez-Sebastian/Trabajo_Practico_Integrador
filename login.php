<?php
include 'header1.php';
session_start();

// Verificar si el usuario ya ha iniciado sesión y redirigirlo a la página de registros
if (isset($_SESSION['usuario'])) {
    header("Location: listaCliente.php");
    exit();
}

// Verificar si se envió el formulario de inicio de sesión
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Conectarse a la base de datos (reemplaza los valores con tus credenciales)
    $conexion = mysqli_connect('localhost', 'root', '', 'govetku');

    // Verificar si la conexión es exitosa
    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Consultar la tabla usuarios para verificar el inicio de sesión
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = MD5('$clave')";
    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si se encontró un registro coincidente
    if (mysqli_num_rows($resultado) == 1) {
        // Inicio de sesión exitoso, almacenar el nombre de usuario en la sesión y redirigir a la página de registros
        $_SESSION['usuario'] = $usuario;
        header("Location: listaCliente.php");
        exit();
    } else {
        // Credenciales inválidas, mostrar un mensaje de error
        $mensaje = "Nombre de usuario o contraseña incorrectos.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    
</head>



<body>
    <div class="login-container">
        <div class="login-form">
        <h2>Iniciar sesión</h2>
            <?php if (isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
            <form method="post" action="">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" required><br>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" required><br>
                <input type="submit" name="login" value="Iniciar sesión">
            </form>
        </div>
    </div>    
</body>
</html>
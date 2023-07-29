<?php
include 'header1.php';
session_start();

//mostrar la lista de clienets y sus mascotas
// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Conectarse a la base de datos (reemplaza los valores con tus credenciales)
$conexion = mysqli_connect('localhost', 'root', '', 'govetku');

// Verificar si la conexión es exitosa
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Consultar la tabla clientes para obtener los registros
$consulta_clientes = "SELECT clientes.*, mascotas.Nombre AS nombre_mascota , mascotas.TipoDeMascota AS Tipo , mascotas.idMascota AS idMascota
FROM clientes
LEFT JOIN mascotas ON clientes.idCliente = mascotas.idCliente";
$resultado_clientes = mysqli_query($conexion, $consulta_clientes);


//eliminar una mascota de la lista
if (isset($_POST['eliminar_mascota'])) {
    $idMascotaEliminar = $_POST['id_mascota_eliminar'];

    // Conectarse a la base de datos (reemplaza los valores con tus credenciales)
    $conexion = mysqli_connect('localhost', 'root', '', 'govetku');

    // Verificar si la conexión es exitosa
    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Consulta para eliminar el registro de la tabla mascotas
    $consulta_eliminar_mascota = "DELETE FROM mascotas WHERE idMascota = $idMascotaEliminar";
    $resultado_eliminar_mascota = mysqli_query($conexion, $consulta_eliminar_mascota);

    // Verificar si se eliminó la mascota correctamente
    if ($resultado_eliminar_mascota) {
        // La mascota se eliminó exitosamente, mostrar alerta
        echo "<script>alert('Mascota eliminada exitosamente');</script>";
    } else {
        // Ocurrió un error al eliminar la mascota, mostrar alerta
        echo "<script>alert('Error al eliminar la mascota');</script>";
    }

    header("Refresh:0");

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Registros de clientes</title>
    <link rel="stylesheet" href="style/stylephp.css" />
    <link rel="stylesheet" href="style/bootstrap.min.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="style/estiloAlternativo.css" />
    <style>
        H1{
            margin: 10px 0;
            color: #007bff;
            text-align: center;
        }
        H4{
            margin: 10px 0;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container estilo2">
        <div class= "titulo">
            <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
            <h4>Registros de clientes:</h4>
        </div>
        <div class = "tabla">    
        <table class="table">
    <thead>
        <tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Tipo</th>
            <th>idMascota</th>
            <th>Nombre Mascota</th>
            <th style="text-align: center;">Acciones</th> <!-- Nueva columna para los botones de acción -->
        </tr>
    </thead>
    <tbody>
        <?php while ($fila_cliente = mysqli_fetch_assoc($resultado_clientes)) { ?>
            <tr>
                <td><?php echo $fila_cliente['idCliente']; ?></td>
                <td><?php echo $fila_cliente['Nombre']; ?></td>
                <td><?php echo $fila_cliente['Apellido']; ?></td>
                <td><?php echo $fila_cliente['Tipo']; ?></td>
                <td><?php echo $fila_cliente['idMascota']; ?></td>
                <td><?php echo $fila_cliente['nombre_mascota']; ?></td>
                <td style="text-align: center;">
                    <!-- Formulario para modificar la mascota -->
                    <form method="post" action="">
                        <input type="hidden" name="id_mascota_modificar" value="<?php echo $fila_cliente['idMascota'];?>">
                        <a href="modificar.php?idMascota=<?php echo $fila_cliente['idMascota'];?>" class="btn btn-warning btn-sm" name="modificar_mascota" style="margin-top:0px;"><i class='bi bi-pencil-square' style="font-size: 16px;"></i></a>
                        <!-- </form>
                </td>
                <td>
                    <form method="post" action=""> -->
                        <input type="hidden" name="id_mascota_eliminar" value="<?php echo $fila_cliente['idMascota'];?>">
                        <button class="btn btn-danger btn-sm" type="submit" name="eliminar_mascota"><i class='bi bi-trash' style="font-size: 16px;"></i></button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
            <br>
            <a href="logout.php" class="btn btn-primary">Cerrar sesión</a> <!-- Agrega un archivo logout.php para cerrar la sesión -->
            <a href="alta.php" class="btn btn-success">Nueva Mascota</a>
        </div>
    </div>    
</body>
</html>
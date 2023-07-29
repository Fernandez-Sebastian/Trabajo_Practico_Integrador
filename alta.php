<?php
include 'header1.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>Alta de Mascota</title>
</head>
<body>
    <h2>Alta de Mascota</h2>
    <?php
    // Procesar el formulario cuando se envíe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conexión a la base de datos (reemplaza los valores con los de tu configuración)
        $host = "localhost";
        $usuario = "root";
        $contrasena = "";
        $base_de_datos = "govetku";

        $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Obtener los datos del formulario
        $idCliente = $_POST['idCliente'];
        $nombre = $_POST['nombre'];
        $tipoMascota = $_POST['tipoMascota'];
        $fechaNacimiento = $_POST['fechaNacimiento'];

        // Preparar la consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO mascotas (idCliente, Nombre, TipoDeMascota, FechaNacimiento)
                VALUES ('$idCliente', '$nombre', '$tipoMascota', '$fechaNacimiento')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
        // La mascota se modificó exitosamente, mostrar alerta
        echo "<script>alert('La mascota se ha dado de alta exitosamente.');</script>";
    } else {
        // Ocurrió un error al modificar la mascota, mostrar alerta
        echo "<script>alert('Error al dar de alta la mascota.');</script>";
    }

            // Redireccionar a listacliente.php
            header("Refresh:0;url=listacliente.php");
        // Cerrar la conexión
        $conn->close();
    }
    ?>

<div class="container mt-5">
        <h2>Alta de Mascota</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>ID Cliente:</label>
                <input type="text" name="idCliente" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nombre de la Mascota:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tipo de Mascota:</label>
                <select name="tipoMascota" class="form-control">
                    <option value="perro">Perro</option>
                    <option value="gato">Gato</option>
                    <option value="ave">Ave</option>
                    <option value="reptil">Reptil</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento:</label>
                <input type="date" name="fechaNacimiento" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Guardar Mascota</button>
        </form>
        <div class="d-flex justify-content-end mt-3">
            <a href="listacliente.php" class="btn btn-success">Volver A La Lista</a>
        </div>
    </div>

    <!-- Agrega el enlace al archivo de JavaScript de Bootstrap (opcional, pero puede ser útil para algunas funciones de Bootstrap) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
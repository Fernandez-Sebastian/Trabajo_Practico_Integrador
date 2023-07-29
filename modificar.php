<?php
include 'header1.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Mascota</title>
</head>
<body>
    <h2>Modificar Mascota</h2>

    <?php
    // Verificar si se ha enviado el formulario de modificación
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar_mascota'])) {
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
        $idMascota = $_POST['idMascota'];
        $nombre = $_POST['nombre'];
        $tipoMascota = $_POST['tipoMascota'];
        $fechaNacimiento = $_POST['fechaNacimiento'];

        // Preparar la consulta SQL para actualizar los datos de la mascota en la base de datos
        $sql = "UPDATE mascotas SET Nombre = '$nombre', TipoDeMascota = '$tipoMascota', FechaNacimiento = '$fechaNacimiento'
                WHERE idMascota = $idMascota";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
                // La mascota se modificó exitosamente, mostrar alerta
                echo "<script>alert('Mascota modificada exitosamente');</script>";
            } else {
                // Ocurrió un error al modificar la mascota, mostrar alerta
                echo "<script>alert('Error al modificar la mascota');</script>";
            }
            // Redireccionar a listacliente.php
            header("Refresh:0;url=listacliente.php");
      

        // Cerrar la conexión
        $conn->close();
    } else {
        // Si no se ha enviado el formulario de modificación, cargar los datos de la mascota existente
        if (isset($_GET['idMascota'])) {
            $idMascota = $_GET['idMascota'];

            // Conexión a la base de datos y consulta para obtener los datos de la mascota
            $conexion = mysqli_connect('localhost', 'root', '', 'govetku');

            // Verificar si la conexión es exitosa
            if (!$conexion) {
                die("Error al conectar con la base de datos: " . mysqli_connect_error());
            }

            // Consultar la tabla clientes para obtener los registros
            $consulta_clientes = "SELECT *
            FROM mascotas
            WHERE mascotas.idMascota=$idMascota";
            $resultado_clientes = mysqli_query($conexion, $consulta_clientes);

            // Cargar los datos de la mascota en el formulario
            if ($fila_cliente = mysqli_fetch_assoc($resultado_clientes)) {
            
                $nombre =  $fila_cliente['Nombre']; 
                $tipoMascota =   $fila_cliente['TipoDeMascota']; 
                $fechaNacimiento =   $fila_cliente['FechaNacimiento']; 

            }           

        }
    }
    ?>

    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="idMascota" value="<?php echo $idMascota; ?>">
            <div class="form-group">
                <label>Nombre de la Mascota:</label>
                <input type="text" name="nombre" class="form-control" required value="<?php echo $nombre; ?>">
            </div>

            <div class="form-group">
                <label>Tipo de Mascota:</label>
                <select name="tipoMascota" class="form-control">
                    <option value="perro" <?php if ($tipoMascota == 'Perro') echo 'selected'; ?>>Perro</option>
                    <option value="gato" <?php if ($tipoMascota == 'Gato') echo 'selected'; ?>>Gato</option>
                    <option value="ave" <?php if ($tipoMascota == 'Ave') echo 'selected'; ?>>Ave</option>
                    <option value="otro" <?php if ($tipoMascota == 'Reptil') echo 'selected'; ?>>Reptil</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento:</label>
                <input type="date" name="fechaNacimiento" class="form-control" required value="<?php echo $fechaNacimiento; ?>">
            </div>

            <button type="submit" name="modificar_mascota" class="btn btn-primary" style="margin-top: 10px;">Guardar Cambios</button>
            <a href="listacliente.php" class="btn btn-success" style="margin-top: 10px;">Volver A La Lista</a>
           </form>
    </div>

    <!-- Agrega el enlace al archivo de JavaScript de Bootstrap (opcional, pero puede ser útil para algunas funciones de Bootstrap) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

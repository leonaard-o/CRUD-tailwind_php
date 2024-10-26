<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$imagen = $_POST['imagen'];

// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Prepara la consulta SQL
$sql = "INSERT INTO productos (nombre, cantidad, precio, categoria,imagen) VALUES ('$nombre', '$cantidad', '$precio', '$categoria','$imagen')";

// Intenta ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "ok";
} else {
    echo "Error: " . $conn->error; // Mostrar el error si la consulta falla
}

$conn->close(); // Cerrar la conexión
?>
<?php
// Incluye el archivo de conexión a la base de datos
/*include "conexion.php";
print_r($_POST);
// Obtén los datos del producto desde la solicitud POST
$nombre = $_POST['nombre'] ?? null;
$cantidad = $_POST['cantidad'] ?? null;
$precio = $_POST['precio'] ?? null;
$categoria = $_POST['categoria'] ?? null;
// Verifica que todos los campos estén presentes
if ($nombre === null || $cantidad === null || $precio === null || $categoria === null) {
    echo "Datos inválidos.";
    exit;
}
try {
    // Prepara la consulta SQL con PDO
    $sql = "INSERT INTO productos (nombre, cantidad, precio, categoria) 
            VALUES (:nombre, :cantidad, :precio, :categoria)";
    // Prepara la consulta utilizando PDO
    $stmt = $conn->prepare($sql);
    // Vincula los parámetros con valores
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':categoria', $categoria);
    
    // Ejecuta la consulta
    $stmt->execute();
    $last_id = $conn->lastInsertId();
    echo "Nuevo registro creado con éxito. ID insertado: " . $last_id;
} catch (PDOException $e) {
    echo "Error al crear el producto: " . $e->getMessage();
}
$conn = null;
?>*/
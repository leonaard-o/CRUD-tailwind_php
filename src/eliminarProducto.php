<?php
include "conexion.php"; // Asegúrate de que esta ruta sea correcta

// Obtén el ID del producto a eliminar desde la solicitud AJAX
$id = $_POST['id'];

// Verifica que el ID sea un número
if (is_numeric($id)) {
    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado con éxito.";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
} else {
    echo "ID inválido.";
}

$conn->close();
?>
 <?php
// Incluye el archivo de conexión a la base de datos
/*include "conexion.php";

// Obtén el ID del producto a eliminar desde la solicitud AJAX
$id = $_POST['id'] ?? null;

// Verifica que el ID sea un número
if (is_numeric($id)) {
    try {
        // Prepara la consulta SQL con PDO
        $sql = "DELETE FROM productos WHERE id = :id";
        
        // Prepara la consulta utilizando PDO
        $stmt = $conn->prepare($sql);
        
        // Vincula el parámetro ID
        $stmt->bindParam(':id', $id);
        
        // Ejecuta la consulta
        $stmt->execute();
        
        echo "Producto eliminado con éxito.";
    } catch (PDOException $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}

$conn = null;
?>*/
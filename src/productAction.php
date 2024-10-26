<?php 
include 'conexion.php';

$response = ['error' => 'Acción no válida.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action_type'])) {
    $action_type = $_POST['action_type'];
    
    if ($action_type === 'data' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $query = "SELECT * FROM productos WHERE id = '$id'";
        $result = $conn->query($query);
        $response = $result && $result->num_rows > 0 ? $result->fetch_assoc() : ['error' => "Producto no encontrado."];
    } elseif ($action_type === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $nombre = $conn->real_escape_string($_POST['nombre'] ?? '');
        $cantidad = $conn->real_escape_string($_POST['cantidad'] ?? '');
        $precio = $conn->real_escape_string($_POST['precio'] ?? '');
        $categoria = $conn->real_escape_string($_POST['categoria'] ?? '');
        $imagen = $conn->real_escape_string($_POST['imagen'] ?? '');


        if ($id && $nombre && $cantidad && $precio && $categoria) {
            $query = "UPDATE productos SET nombre = '$nombre', cantidad = '$cantidad', precio = '$precio', categoria = '$categoria', imagen = '$imagen' WHERE id = '$id'";
            $response = $conn->query($query) ? ['success' => "Producto actualizado correctamente."] : ['error' => "Error al actualizar el producto: " . $conn->error];
        } else {
            $response['error'] = "Faltan algunos datos del producto para la actualización.";
        }
    }
} else {
    $response['error'] = "Método de solicitud no válido.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>

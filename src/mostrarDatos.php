<?php
// Código de conexión y consulta
require 'conexion.php';

$query = "SELECT * FROM productos";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td class='px-4 py-2 border-2'>{$row['id']}</td>
            <td class='px-4 py-2 border-2'>{$row['fecha']}</td>
            <td class='px-4 py-2 border-2'>{$row['nombre']}</td>
            <td class='px-4 py-2 border-2'>{$row['cantidad']}</td>
            <td class='px-4 py-2 border-2'>{$row['precio']}</td>
            <td class='px-4 py-2 border-2'>{$row['categoria']}</td>
            <td class='px-4 py-2 border-2'>
                <img  src='{$row['imagen']}' alt='Imagen del producto' width='150' >
            </td>
            <td class='px-4 py-2 border'>
                <button class='px-2 py-1 text-white bg-yellow-500 rounded' onclick='editItem({$row['id']})'>Editar</button>
                <button class='px-2 py-1 text-white bg-red-500 rounded' onclick='deleteItem({$row['id']})'>Eliminar</button>
            </td>
          </tr>";
}
mysqli_free_result($result); // Libera la memoria utilizada por el resultado
mysqli_close($conn); // Cierra la conexión con la base de datos
?>


<?php
// Incluye el archivo de conexión a la base de datos
/*include "conexion.php";

// Consulta SQL para seleccionar todos los productos de la base de datos
$sql = "SELECT id, fecha, nombre, cantidad, precio, categoria FROM productos";

// Ejecuta la consulta utilizando PDO
$stmt = $conn->prepare($sql);
$stmt->execute();

// Verifica si hay resultados
if ($stmt->rowCount() > 0) {
    // Recorre cada fila de resultados y genera las filas de la tabla
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['fecha'] . "</td>
            <td>" . $row['nombre'] . "</td>
            <td>" . $row['cantidad'] . "</td>
            <td>" . $row['precio'] . "</td>
            <td>" . $row['categoria'] . "</td>
            <td>
                <button class='px-2 py-1 text-white bg-yellow-500 rounded' onclick='editItem(" . $row['id'] . ")'>Editar</button>
                <button class='px-2 py-1 text-white bg-red-500 rounded' onclick='deleteItem(" . $row['id'] . ")'>Eliminar</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron productos.</td></tr>"; // Mensaje si no hay productos
}

?>*/
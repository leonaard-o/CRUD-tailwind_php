<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "tienda";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $db);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

try {
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $conn = new PDO($dsn, $username, $password, $options);
    
    echo "Conexión exitosa";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>*/
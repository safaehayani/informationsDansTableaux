<?php
// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 't';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'image de la base de données
$sql = "SELECT image_name, image_data FROM images ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageName = $row['image_name'];
    $imageData = $row['image_data'];

    // Afficher l'image
    header("Content-type: image/*");
    echo $imageData;
} else {
    echo "Image not found.";
}

// Fermer la connexion à la base de données
$conn->close();
?>

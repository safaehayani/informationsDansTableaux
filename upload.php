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

if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $imageName = $conn->real_escape_string($_FILES['image']['name']);

    // Utilisation d'une requête préparée pour insérer les données
    $sql = "INSERT INTO images (image_name, image_data) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bind_param("ss", $imageName, $imageData);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    // Fermer la déclaration préparée
    $stmt->close();
} else {
    echo "Error uploading image.";
}

// Fermer la connexion à la base de données
$conn->close();
?>

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

    // Fermer la connexion à la base de données avant d'afficher l'image
    $conn->close();

    // Afficher l'image dans une carte stylisée avec une animation et un bouton "Envoyer"
    echo '<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Display Image</title>
              <style>
                  @keyframes borderAnimation {
                      0% { border-width: 1px; }
                      50% { border-width: 10px; }
                      100% { border-width: 1px; }
                  }

                  .card {
                      width: 18rem;
                      border: 1px solid #ccc;
                      padding: 10px;
                      margin: 10px;
                      animation: borderAnimation 3s infinite ;
                  }

                  .card img {
                      width: 100%;
                      height: auto;
                      border-radius: 8px; 
                  }

                  .send-button {
                      display: block;
                      margin-top: 10px;
                      padding: 8px 16px;
                      background-color: #4CAF50;
                      color: #fff;
                      border: none;
                      border-radius: 4px;
                      cursor: pointer;
                      transition: background-color 0.3s;
                  }

                  .send-button:hover {
                      background-color: #45a049;
                  }
              </style>
          </head>
          <body>
              <div class="card">
                  <img src="data:image/*;base64,' . base64_encode($imageData) . '" alt="' . $imageName . '">
                  <p>' . $imageName . '</p>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>

                  <button class="send-button" onclick="alert(\'Image envoyée !\')">Envoyer</button>
              </div>
          </body>
          </html>';
} else {
    echo "Image not found.";
}
?>

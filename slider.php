<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="slider.css">
    <title>Image Slider</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js        ">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-success btn-color-success">
                    <div class="container-fluid">
                      <a class="navbar-brand" href="#">Gestionnaire des images</a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav justify-content-center nav nav-underline nav nav-tabs" id="myTab" role="tablist me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link"  aria-current="page" href="#">About</a>
                          </li>
                          <li class="nav-item">
                                <a class="nav-link"  aria-current="page" href="#">Services</a>
                              </li>
                              <li class="nav-item">
                                    <a class="nav-link"  aria-current="page" href="#">contact</a>
                                  </li>
                        
                                </div>
                    <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                          </form>
                    </div>
                  </nav>
    

    <!--slider-->
    <div class="slider-container">
        <div class="slider">
            <div class="slide"><img src="img1.jpeg" alt="img1.jpeg" ></div>
            <div class="slide"><img src="img2.jpeg" alt="img2.jpeg"></div>
            <div class="slide"><img src="img3.jpeg" alt="img3.jpeg"></div>
        </div>
    </div>
    <script src="slider.js"></script>

</body>
</html>
 
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
                      animation: borderAnimation 3s infinite;
                  }

                  .card img {
                      width: 100%;
                      height: auto;
                      border-radius: 8px; /* Ajout de coins arrondis à limage */
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
          </html>';
          
          // Afficher l'image précédente
$sql = "SELECT image_name, image_data FROM images ORDER BY id DESC LIMIT 1 OFFSET 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageNamePrev = $row['image_name'];
    $imageDataPrev = $row['image_data'];

    echo '<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Display Image</title>
              <style>
                  /* Votre style CSS ici */
              </style>
          </head>
          <body>
              <div class="card">
                  <img src="data:image/*;base64,' . base64_encode($imageDataPrev) . '" alt="' . $imageNamePrev . '">
                  <p>' . $imageNamePrev . '</p>
                  <button class="send-button" onclick="alert(\'Image envoyée !\')"> <a href="http://localhost/t/tableaux/all_image.php" class="btn btn-primary">Envoyer</a></button>
              </div>';
} else {
    echo "Image précédente non trouvée.";
}

// Afficher la dernière image ajoutée
$sql = "SELECT * FROM images ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image_name = $row['image_name'];
    $image_data = base64_encode($row['image_data']);

    // Affichage de la nouvelle carte
    echo "<div class='card'>";
    echo "<img src='data:image/jpeg;base64,{$image_data}' alt='{$image_name}' />";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>{$image_name}</h5>";
    echo "<p class='card-text'>Description de l'image</p>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Aucune image trouvée.";
}

} else {
    echo "Image not found.";
}
$conn->close();
?>


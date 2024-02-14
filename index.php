<?php
require 'connexion.php';

// Traitement de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['Title'];
    $description = $_POST['Description'];

    if (empty($id)) {
        // Ajout d'un nouvel enregistrement
        $sql = "INSERT INTO projetexamain (Title, Description) VALUES ('$title', '$description')";
    } else {
        // Modification d'un enregistrement existant
        $sql = "UPDATE projetexamain SET Title='$title', Description='$description' WHERE id='$id'";
    }

    if (mysqli_query($con, $sql)) {
        echo "Données enregistrées avec succès.";
        
        // Redirection vers AffichageCreate.php après la soumission
        header('Location: AffichageCreate.php');
        exit();
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
    }
}

// Récupération des données pour la modification
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM projetexamain  WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $Title = $row['Title'];
    $Description = $row['Description'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="formulaire1.css">
</head>
<body>
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Add News item</div>
        <div class="inputs">
            <form method="POST" action="index.php">
                <input type="hidden" name="id" value="<?php if (isset($id)) echo $id; ?>">
                <input type="text" name="Title" placeholder="Entrer votre Title" value="<?php if (isset($Title)) echo $Title; ?>"><br><br>
                <input type="text" name="Description" placeholder="Entrer votre Description" value="<?php if (isset($Description)) echo $Description; ?>"><br><br>
                <button type="submit">
                    <?php
                    if (isset($id)) {
                        echo "Modifier";
                    } else {
                        echo "Submit";
                    }
                    ?>
                </button>
            </form>
        </div> 
        <a href="AffichageCreate.php">Affichage</a>
    </div>
</body>
</html>

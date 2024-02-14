<?php
require 'connexion.php'; //require include :pour prendre le code de connexion entre php et DB (require:mieux si une erreure il affiche seulement l'erreure)(include:si une erreure il affiche l'erreure et continue l'Execution de page)

if(isset($_GET['id'])){
    $Title=$_POST['Title'];//recupération des champs /input
$Description=$_POST['Description'];
$Image=$_POST['Image'];
$id=$_POST['id'];
$sql="UPDATE projetexamain set Title='$Title',Description='$Description',Image='$Image'where id='$id'";
$q=mysqli_query($con,$sql);
if(isset($q)){
    echo"<h1>Modification Avec Success</h1>"; 
}
}else{
$Title=$_POST['Title'];      //recupération des champs si une probleme ecriver /input/*if (isset($_POST['Title'])) {
    $Title = $_POST['Title'];
}
$Description=$_POST['Description'];


    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['Image'])) {
        $file = $_FILES['Image'];

        // Vérifier s'il n'y a pas d'erreur lors du téléchargement
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Déplacer le fichier téléchargé vers un emplacement approprié
            $uploadDir = 'uploads/'; // Assurez-vous que ce dossier existe et a les autorisations nécessaires
            $uploadPath = $uploadDir . basename($file['name']);

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Le fichier a été téléchargé avec succès, maintenant vous pouvez l'insérer dans la base de données
                $sql = "INSERT INTO projetexamain (Title, Description, Image) VALUES ('$Title', '$Description', '$uploadPath')";
                $query = mysqli_query($con, $sql);

                if ($query) {
                    echo "<h1>Insertion réussie avec succès</h1>";
                } else {
                    echo "<h1>Erreur d'insertion dans la base de données</h1>";
                }
            } else {
                echo "<h1>Erreur lors du déplacement du fichier téléchargé</h1>";
            }
        } else {
            echo "<h1>Erreur lors du téléchargement du fichier</h1>";
        }
    } else {
        echo "<h1>Aucun fichier téléchargé</h1>";
    }

     // Redirection vers la page souhaitée après le traitement
     header('Location: http://localhost/PROJETEXAMAIN/AffichageCreate.php');

//insertion des donner
$requete="INSERT INTO projetexamain(Title,Description) VALUES('$Title','$Description')";
$query=mysqli_query($con,$requete);//mysqli_query:pour lire les requete SQL
if(isset($query)){ //vérification des requete inserer
    echo"<h1>Insertion Avec Success</h1>";
}
else{
    echo"<h1>Erreur d'Insertion</h1>";
}
?>

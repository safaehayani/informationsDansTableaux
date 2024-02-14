<?php
require 'connexion.php';
$id=$_GET['id'];
$sql="DELETE FROM projetexamain Where id='$id'" ;// Modifier table
$query=mysqli_query($con,$sql);
if(isset($query)){ //vérification des requete inserer
   header("location:AffichageCreate.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><!--fontawesom-->
    <style>
        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .blue-background {
            background-color: #3498db; /* Bleu */
            color: white;
        }

        .animated-icon {
            font-size: 18px;
            margin: 0 5px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .animated-icon:hover {
            transform: scale(1.2);
        }

        .delete-icon {
            color: #ff5252; /* Rouge */
        }

        .edit-icon {
            color: #f9ca24; /* Jaune */
        }
    </style>
</head>
<body>
    <h1>Data</h1>
    <hr>
    <h1>Afficher les éléments de DB en tableaux</h1>
    <table border="1" width="90%">
        <tr>
            <th class="blue-background">Title</th>
            <th class="blue-background">Description</th>
            <th class="blue-background">Actions</th>
        </tr>

        <?php
        require 'connexion.php';
        $requete = "SELECT * FROM projetexamain";
        $query = mysqli_query($con, $requete);

        while ($rows = mysqli_fetch_assoc($query)) {
            $id = $rows['id'];
            echo "<tr>";
            echo "<td>" . $rows['Title'] . "</td>";
            echo "<td>" . $rows['Description'] . "</td>";
            echo "<td>
                    <a href='delete.php?id=" . $id . "' class='animated-icon delete-icon'><i class='fas fa-trash-alt'></i></a>
                    <a href='index.php?id=" . $id . "' class='animated-icon edit-icon'><i class='fas fa-edit'></i></a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
<!--La fonction base64_encode est une fonction de PHP qui encode une chaîne de données en utilisant l'algorithme d'encodage base64. Cela signifie qu'il prend une chaîne binaire (généralement des données binaires, comme une image) et la convertit en une chaîne de caractères base64.
La fonction renvoie la chaîne de caractères encodée en base64. Cette chaîne est généralement utilisée pour représenter des données binaires de manière textuelle, par exemple, lorsqu'on souhaite incorporer une image directement dans une page HTML ou lorsqu'on transmet des données binaires via des protocoles qui acceptent uniquement des données texte.-->
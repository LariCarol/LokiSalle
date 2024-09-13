<?php
session_start();

if (!isset($_SESSION['membre_statut']) || $_SESSION['membre_statut'] != 1) {
    echo "<script>
            alert('Vous devez être un admin pour utiliser cette page!');
            window.location.href = '../index.php';
        </script>";
    exit();
}
include("includes/connection.inc.php");
include("includes/head.php");
include("includes/main.php");
include("includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokiSalle</title>
</head>
<body>
<h1>Gestion des Avis</h1>

<table>
    <thead>
        <tr>
            <th>id avis</th>
            <th>id membre</th>
            <th>id salle</th>
            <th>Commentaire</th>
            <th>Note</th>
            <th>date_enregistrement</th>
            <th>actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>28 - amandine28@gmail.com</td>
            <td>692 - Salle Renoir</td>
            <td>La salle était vraiment spacieuse. TOP</td>
            <td>5 etoiles</td>
            <td>06/06/2024 14:45</td>
            <td>
                <a href="#">&#128269;</a>
                <a href="#">&#9998;</a>
                <a href="#">&#128465;</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>35 - clement@gmail.com</td>
            <td>750 - Salle Picasso</td>
            <td>La salle était conforme à l'annonce, mais manque de luminosité.</td>
            <td>3 etoiles</td>
            <td>20/06/2024 14:45</td>
            <td>
                <a href="#">&#128269;</a>
                <a href="#">&#9998;</a>
                <a href="#">&#128465;</a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>39 - thomas@gmail.com</td>
            <td>750 - Bureau Picasso</td>
            <td>Le bureau est parfait pour une utilisation ponctuelle.</td>
            <td>4 etoiles</td>
            <td>30/06/2024 14:45</td>
            <td>
                <a href="#">&#128269;</a>
                <a href="#">&#9998;</a>
                <a href="#">&#128465;</a>
            </td>
        </tr>
    </tbody>
</table>


<?php include "includes/footer.php" ?>
</body>
</html>
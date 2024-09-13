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
    <title>Document</title>
</head>
<body>
<h1>Gestion des Produits</h1>

<?php

$query = "
SELECT * FROM produit WHERE 1;
";

$stmt = mysqli_prepare($con, $query);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo '
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>id produit</th>
                <th>date d\'arrivée</th>
                <th>date de depart</th>
                <th>id salle</th>
                <th>prix</th>
                <th>etat</th>
            </tr>
        </thead>
        <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
            <td>' . htmlspecialchars($row['id_produit']) . '</td>
            <td>' . htmlspecialchars($row['date_arrive']) . '</td>
            <td>' . htmlspecialchars($row['date_depart']) . '</td>
            <td>' . htmlspecialchars($row['id_salle']) . '</td>
            <td>' . htmlspecialchars($row['prix']) . '</td>
            <td>' . htmlspecialchars($row['etat']) . '</td>
        </tr>';
    }
    
    echo '
        </tbody>
    </table>';
} else {
    echo 'Aucune commande trouvée.';
}

mysqli_stmt_close($stmt);

$query = "SELECT id_salle, titre FROM salle WHERE 1";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "Erreur lors de la récupération des salles.";
    exit();
}

?>

<div class="container mt-5 form-container">
    <form method="POST" action="includes/enregistrer_produit.inc.php">

        <div class="form-group">
            <label for="arrivalDate">Date d'arrivée</label>
            <input type="datetime-local" class="form-control" id="arrivalDate" name="arrivalDate" required>
        </div>
        
        <div class="form-group">
            <label for="departureDate">Date de départ</label>
            <input type="datetime-local" class="form-control" id="departureDate" name="departureDate" required>
        </div>

        <div class="form-group">
            <label for="salle">Salle</label>
            <select class="form-control" id="salle" name="salle" required>
                <option value="">Sélectionner</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . htmlspecialchars($row['id_salle']) . '">' . htmlspecialchars($row['titre']) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tarif">Tarif</label>
            <input type="text" class="form-control" id="tarif" name="tarif" required pattern="[0-9]{1,5}" title="Veuillez entrer un tarif valide">
        </div>
      
        <button type="submit" class="btn btn-primary mb-4">Enregistrer</button>
    </form>
</div>

<?php 

mysqli_close($con);
?>

<?php include "includes/footer.php" ?>
</body>
</html>

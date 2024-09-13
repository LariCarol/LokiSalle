<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['membre_statut']) || $_SESSION['membre_statut'] != 1) {
    echo "<script>
            alert('Vous devez être un admin pour utiliser cette page!');
            window.location.href = '../index.php';
        </script>";
    exit();
}


include("./includes/connection.inc.php");
include("./includes/head.php");
include("./includes/main.php");
include("./includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokiSalle</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<h1>Gestion des Salles</h1>

<?php

$query = "
SELECT * FROM salle WHERE 1;
";

$stmt = mysqli_prepare($con, $query);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo '
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>id_salle</th>
                <th>titre</th>
                <th>description</th>
                <th>photo</th>
                <th>pays</th>
                <th>ville</th>
                <th>adresse</th>
                <th>cp</th>
                <th>capacité</th>
                <th>catégorie</th>
            </tr>
        </thead>
        <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
            <td>' . $row['id_salle'] . '</td>
            <td>' . $row['titre'] . '</td>
            <td>' . $row['description'] . '</td>
            <td><img style="width:100px;" src=images/' . $row['photo'] . '></td>
            <td>' . $row['pays'] . '</td>
            <td>' . $row['ville'] . '</td>
            <td>' . $row['adresse'] . '</td>
            <td>' . $row['cp'] . '</td>
            <td>' . $row['capacite'] . '</td>
            <td>' . $row['categorie'] . '</td>

        </tr>';
    }
    
    echo '
        </tbody>
    </table>';
} else {
    echo 'Aucune commande trouvée.';
}

mysqli_stmt_close($stmt);
mysqli_close($con);

?>

<div class="container mt-5 form-container">
<form action="./includes/enregistrer_salle.inc.php" method="post">

<div class="form-group">
          <label for="titre">Titre *</label>
          <input type="text" class="form-control" id="titre" name="titre" required pattern="[A-Za-zÀ-ÿ\s-]+">
      </div>

      <div class="form-group mb-3">
          <label for="description">DESCRIPTION *</label>
          <textarea class="form-control" id="description" name="description" required rows="5"></textarea>
      </div>

      <div class="form-group mb-2">
          <label for="photo">Photo</label>
          <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png" maxlength="10485760">
          <small class="form-text text-muted">Aucun fichier Sélectionner</small>
      </div>
      
      <div class="form-group">
          <label for="capacite">Capacité</label>
          <select class="form-control" id="capacite" name="capacite">
                <option value="">Selectioner</option>
                <option value="1-5">1 - 5</option>
                <option value="6-10">6 - 10</option>
                <option value="11-20">11 - 20</option>
                <option value="21-40">21 - 40</option>
          </select>
      </div>

      <div class="form-group">
          <label for="categorie">Categorie</label>
          <select class="form-control" id="categorie" name="categorie">
                <option value="">Selectioner</option>
                <option value="reunion">Réunion</option>
                <option value="formation">Formation</option>
                <option value="salle">Salle</option>
          </select>
      </div>

      <div class="form-group">
          <label for="pays">Pays</label>
        <select class="form-control" id="pays" name="pays">
            <option value="">Selectioner</option>      
            <option value="france">France</option>
        </select>
      </div>

      <div class="form-group">
          <label for="ville">Ville</label>
          <select class="form-control" id="ville" name="ville">
                <option value="paris">Paris</option>
                <option value="marseille">Marseille</option>
                <option value="lyon">Lyon</option>
          </select>
      </div>

      <div class="form-group mb-3">
          <label for="adresse">Adresse</label>
          <textarea class="form-control" id="adresse" name="adresse" required rows="5"></textarea>
      </div>

      <div class="form-group">
          <label for="postalCode">CODE POSTAL</label>
          <input type="text" class="form-control" id="postalCode" name="postalCode" required pattern="[0-9]{5}">
      </div>
      
      <button type="submit" class="btn btn-primary mb-4">Enregistrer</button>
  </form>
</div>

<?php include "./includes/footer.php" ?>
</body>
</html>
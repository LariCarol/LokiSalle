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
<h1>Gestion des Membres</h1>

<?php

$query = "
SELECT * FROM membre WHERE 1;
";

$stmt = mysqli_prepare($con, $query);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo '
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>id_membre</th>
                <th>pseudo</th>
                <th>nom</th>
                <th>prénom</th>
                <th>email</th>
                <th>civilité</th>
                <th>statut</th>
                <th>date_enregistrement</th>
            </tr>
        </thead>
        <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $statut = $row['statut'] == 1 ? 'admin' : 'membre';
        echo '
        <tr>
            <td>' . $row['id_membre'] . '</td>
            <td>' . $row['pseudo'] . '</td>
            <td>' . $row['nom'] . '</td>
            <td>' . $row['prenom'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['civilite'] . '</td>
            <td>' . $statut . '</td>
            <td>' . $row['date_enregistrement'] . '</td>
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
<form action="./includes/enregistrer_membre.inc.php" method="post">
<div class="form-group">
          <label for="pseudo">Pseudo</label>
          <input type="text" class="pseudo" id="pseudo" name="pseudo" required>
      </div>
      <div class="form-group">
                        <label>Mot de Passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>

                    <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" class="nom" id="nom" name="nom" required pattern="[A-Za-zÀ-ÿ\s-]+">
      </div>
      <div class="form-group">
          <label for="prenom">Prenom</label>
          <input type="text" class="prenom" id="prenom" name="prenom" required pattern="[A-Za-zÀ-ÿ\s-]+">
      </div>
      <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="email" id="email" name="email" required>
      </div>
      <div class="form-group">
          <label for="civilite">Civilité</label>
          <select class="form-control" id="civilite" name="civilite">
                <option value="h">Homme</option>
                <option value="f">Femme</option>
          </select>
      </div>
      <div class="form-group">
          <label for="statut">Statut</label>
          <select class="form-control" id="statut" name="statut">
                <option value="1">Admin</option>
                <option value="2">Membre</option>
          </select>
      </div>
      <button type="submit" class="btn btn-primary mb-4">Enregistrer</button>
  </form>
</div>

<?php include "includes/footer.php" ?>
</body>
</html>
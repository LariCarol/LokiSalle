<?php

include_once './includes/connection.inc.php';

session_start();

include("./includes/connection.inc.php");
include("./includes/main.php");
include("./includes/head.php");
include("./includes/functions.php");

if (isset($_GET["produit"])) {
    $id_produit = (int)$_GET["produit"];
    
    $query = "SELECT s.*, pr.* 
              FROM produit pr 
              JOIN salle s ON pr.id_salle = s.id_salle 
              WHERE pr.id_produit = ?";

    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_produit);

        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $total_row = mysqli_num_rows($result);

        if ($total_row > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $titre = $row['titre'];
                $description = $row['description'];
                $photo = $row['photo'];
                $pays = $row['pays'];
                $ville = $row['ville'];
                $adresse = $row['adresse'];
                $cp = $row['cp'];
                $capacite = $row['capacite'];
                $categorie = $row['categorie'];
                $date_arrive = $row['date_arrive'];
                $date_depart = $row['date_depart'];
                $prix = $row['prix'];
                $etat = $row['etat'];
            }
        } else {
            echo "<script>
                    alert('Produit non trouvé!');
                    window.location.href = './salles.php';
                </script>";
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur dans la préparation de la requête: " . mysqli_error($con);
        exit();
    }

} else {
   echo "<script>
            alert('Produit pas trouvé!');
            window.location.href = './salles.php';
        </script>";
    exit();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <style>
        .room-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px;
        }

        .title-rating {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
        }

        .room-image {
            flex: 1;
            max-width: 50%;
            margin-right: 20px;
        }

        .room-image img {
            width: 100%;
            height: auto;
        }

        .description-section {
            flex: 1;
            max-width: 45%;
        }


        .info-section {
            width: 100%;
            margin-top: 20px;
        }

       .location-price {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            width: 100%;
        }

       
        .info {
            margin-top: 10px;
        }

        .info i {
            margin-right: 5px;
        }

        .map {
            width: 300px;
            height: 200px;
            background-color: #ccc;
        }

        .reserve-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none
        }

    </style>
</head>
<body>

<?php
?>
<div class="room-container">
    <div class="title-rating">
        <h1><?= $titre; ?></h1>
        <form method="POST" action="./includes/reservation.inc.php">
            <input type="hidden" name="id_produit" value="<?= $id_produit; ?>">
            <?php if (isset($_SESSION['membre_pseudo'])): ?>
                <button type="submit" class="reserve-btn">Réserver</button>
            <?php else: ?>
                <p style="color: black;"><a href="membre_login.php" class="reserve-btn">Connectez-vous</a> pour faire une réservation.</p>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="room-image">
        <img src="/Projet_LokiSalle/images/<?= $photo; ?>" alt="Image of <?= $titre; ?>">
    </div>
    
    <div class="description-section">
        <h2>Description</h2>
        <p p style="color: #000"><?= $description; ?></p>
    </div>
    
    <div class="info-section">
        <h2>Informations complémentaires</h2>
        <p style="color: #000"><strong>Arrivée:</strong> <?= date('d/m/Y - H:m:s', strtotime($date_arrive)); ?></p>
        <p style="color: #000"><strong>Départ:</strong> <?= date('d/m/Y - H:m:s', strtotime($date_depart)); ?></p>
        <p style="color: #000"><i class="fas fa-users"></i> <strong>Capacité:</strong> <?= $capacite; ?></p>
        <p style="color: #000"><i class="fas fa-tag"></i> <strong>Catégorie:</strong> <?= $categorie; ?></p>
    </div>
    
    <div class="location-price">
        <div>
            <h3>Localisation</h3>
            <p style="color: #000"><i class="fas fa-map-marker-alt"></i> <strong>Adresse:</strong> <?= $adresse; ?>, <?= $cp; ?> <?= $ville; ?>, <?= $pays; ?></p>
        </div>
        <div>
            <h3>Tarif:</h3>
            <p style="color: #000"><?= $prix; ?> €</p>
        </div>
    </div>
</div>
<?php
?>

</body>
</html>
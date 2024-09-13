<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./connection.inc.php');

    
    $arrivalDate = mysqli_real_escape_string($con, $_POST['arrivalDate']);
    $departureDate = mysqli_real_escape_string($con, $_POST['departureDate']);
    $salle = mysqli_real_escape_string($con, $_POST['salle']);
    $prix = mysqli_real_escape_string($con, $_POST['tarif']);

    
    $query = "INSERT INTO produit (id_salle, date_arrive, date_depart, prix, etat) 
              VALUES (?, ?, ?, ?, 'reservation')";

    
    if ($stmt = mysqli_prepare($con, $query)) {
        
        mysqli_stmt_bind_param($stmt, "ssss", $salle, $arrivalDate, $departureDate, $prix);

       
        if (mysqli_stmt_execute($stmt)) {
           
            echo "<script>
                alert('Le produit a été enregistré avec succès!');
                window.location.href = '../gestion_produits.php';
            </script>";
        } else {
            
            echo "Erreur lors de l'enregistrement : " . mysqli_error($con);
        }

        
        mysqli_stmt_close($stmt);
    } else {
        
        echo "Erreur lors de la préparation de la requête : " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

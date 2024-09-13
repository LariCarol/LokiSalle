<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('connection.inc.php');

$id_membre = $_SESSION['membre_id'];
$membre_pseudo = $_SESSION['membre_pseudo'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produit = (int)$_POST['id_produit'];

    if ($id_produit > 0) {
        mysqli_begin_transaction($con);

        try {
            $query = "UPDATE produit SET etat = 'reservation' WHERE id_produit = ?";

            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt, "i", $id_produit);

                if (mysqli_stmt_execute($stmt)) {
                    $insert_query = "INSERT INTO commande (id_membre, id_produit, date_enregistrement) VALUES (?, ?, NOW())";

                    if ($insert_stmt = mysqli_prepare($con, $insert_query)) {
                        mysqli_stmt_bind_param($insert_stmt, "ii", $id_membre, $id_produit);

                        if (mysqli_stmt_execute($insert_stmt)) {
                            mysqli_commit($con);

                            echo "<script>
                                    alert('Votre réservation a été effectuée avec succès !');
                                    window.location.href = '../salles.php';
                                  </script>";
                        } else {
                            throw new Exception("Erreur: Impossible d'enregistrer la commande.");
                        }

                        mysqli_stmt_close($insert_stmt);
                    } else {
                        throw new Exception("Erreur de préparation: " . mysqli_error($con));
                    }
                } else {
                    throw new Exception("Erreur: Impossible de faire la réservation.");
                }

                mysqli_stmt_close($stmt);
            } else {
                throw new Exception("Erreur de préparation: " . mysqli_error($con));
            }
        } catch (Exception $e) {
            mysqli_rollback($con);
            echo $e->getMessage();
        }

        mysqli_close($con);
    } else {
        echo "ID produit non valide.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}

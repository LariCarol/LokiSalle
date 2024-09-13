<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./connection.inc.php');

    $titre = mysqli_real_escape_string($con, $_POST['titre']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $capacite = (int) $_POST['capacite'];
    $categorie = mysqli_real_escape_string($con, $_POST['categorie']);
    $pays = mysqli_real_escape_string($con, $_POST['pays']);
    $ville = mysqli_real_escape_string($con, $_POST['ville']);
    $adresse = mysqli_real_escape_string($con, $_POST['adresse']);
    $cp = mysqli_real_escape_string($con, $_POST['postalCode']);
    $photo = '';

    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($photo);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['photo']['tmp_name']);
        if($check !== false) {
            if (!file_exists($target_file)) {
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                } else {
                    echo "Désolé, une erreur est survenue lors du téléversement de votre fichier.";
                    exit();
                }
            } else {
                echo "Désolé, le fichier existe déjà.";
                exit();
            }
        } else {
            echo "Le fichier n'est pas une image.";
            exit();
        }
    }

    $query = "INSERT INTO salle (titre, description, capacite, categorie, pays, ville, adresse, cp, photo) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "ssissssss", $titre, $description, $capacite, $categorie, $pays, $ville, $adresse, $cp, $photo);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('La salle a été enregistrée avec succès!');
                window.location.href = '../index.php';
            </script>";

        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($con);
    }

    mysqli_close($con);
}
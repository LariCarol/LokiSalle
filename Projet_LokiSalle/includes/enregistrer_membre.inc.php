<?php
if (isset($_POST)) {

    include_once './connection.inc.php';

    $m_pseudo = trim(mysqli_real_escape_string($con, $_POST['pseudo']));
    $m_mdp = trim(mysqli_real_escape_string($con, $_POST['mdp']));
    $m_nom = trim(mysqli_real_escape_string($con, $_POST['nom']));
    $m_prenom = trim(mysqli_real_escape_string($con, $_POST['prenom']));
    $m_email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $m_civilite = trim(mysqli_real_escape_string($con, $_POST['civilite']));
    $m_statut = trim(mysqli_real_escape_string($con, $_POST['statut']));

    $query_check_pseudo = "SELECT * FROM membre WHERE pseudo = ?";
    $stmt_check_pseudo = mysqli_prepare($con, $query_check_pseudo);
    mysqli_stmt_bind_param($stmt_check_pseudo, "s", $m_pseudo);
    mysqli_stmt_execute($stmt_check_pseudo);
    mysqli_stmt_store_result($stmt_check_pseudo);

    if (mysqli_stmt_num_rows($stmt_check_pseudo) > 0) {
        echo "<script>alert('Ce pseudo existe déjà.')</script>";
        exit();
    }

    $hashed_password = password_hash($m_mdp, PASSWORD_DEFAULT);

    $query_insert_membre = "INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, date_enregistrement, statut) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";

    $stmt_insert_membre = mysqli_prepare($con, $query_insert_membre);
    mysqli_stmt_bind_param($stmt_insert_membre, "ssssssi", $m_pseudo, $hashed_password, $m_nom, $m_prenom, $m_email, $m_civilite, $m_statut);

    if (mysqli_stmt_execute($stmt_insert_membre)) {
            $_SESSION['membre_pseudo'] = $m_pseudo;
            echo "<script>
                alert('Vous êtes inscrit(e) avec succès!');
                window.location.href = '../gestion_membres.php';
            </script>";
    } else {
        echo "<script>alert('Une erreur est survenue lors de l'inscription.')</script>";
    }
}

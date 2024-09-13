<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
if(!isset($_SESSION['membre_pseudo'])){
  echo "<script>window.open('./membre_login.php','_self')</script>";
}
else {
  include("includes/connection.inc.php");
  include("includes/head.php");
  include("includes/functions.php");
  include("includes/main.php");
}

$id_membre = $_SESSION['membre_id'];

$query = "
SELECT 
    c.id_commande, 
    m.id_membre, 
    m.email AS membre_email, 
    p.id_produit, 
    s.titre AS produit_titre, 
    p.date_arrive,
    p.date_depart, 
    p.prix, 
    c.date_enregistrement 
FROM 
    commande c
JOIN 
    membre m ON c.id_membre = m.id_membre
JOIN 
    produit p ON c.id_produit = p.id_produit
JOIN
    salle s ON p.id_salle = s.id_salle
WHERE
    m.id_membre = ?
ORDER BY 
    c.date_enregistrement DESC;
";

$stmt = mysqli_prepare($con, $query);

mysqli_stmt_bind_param($stmt, "i", $id_membre);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo '
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>id commande</th>
                <th>id membre</th>
                <th>id produit</th>
                <th>prix</th>
                <th>date_enregistrement</th>
            </tr>
        </thead>
        <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
            <td>' . $row['id_commande'] . '</td>
            <td>' . $row['id_membre'] . ' - ' . $row['membre_email'] . '</td>
            <td>' . $row['id_produit'] . ' - ' . $row['produit_titre'] . '<br>' .
                date('d/m/Y', strtotime($row['date_arrive'])) . ' au ' . 
                date('d/m/Y', strtotime($row['date_depart'])) . '</td>
            <td>' . $row['prix'] . ' €</td>
            <td>' . date('d/m/Y H:i', strtotime($row['date_enregistrement'])) . '</td>
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

include("includes/footer.php");?>
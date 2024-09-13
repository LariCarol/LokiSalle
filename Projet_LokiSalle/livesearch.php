<?php
$con = mysqli_connect("localhost", "root", "", "lokisalle");
if(isset($_REQUEST["term"])){
    $sql = "SELECT * FROM salle WHERE titre LIKE ?";
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $param_term = $_REQUEST["term"] . '%';
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<section>
                    <a class ='dropdown-result' href='".$row["titre"]."'><img src='/Projet_LokiSalle/images/".$row["photo"]."' style=' width:100px;'><p>". $row["titre"] ."</a></p>
                    </section>";
                }
            } else{
                echo "<p> Pas de produits trouvés</p>";
            }
        } else{
            echo "ERREUR: requete non exécutable $sql. " . mysqli_error($con);
        }
    }
}
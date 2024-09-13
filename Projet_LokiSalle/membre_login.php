<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require("./includes/connection.inc.php");
require("./includes/functions.php");
require("./includes/head.php");
require("./includes/main.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
        $membre_pseudo = trim(mysqli_real_escape_string($con, $_POST['pseudo']));
        $membre_mdp = trim(mysqli_real_escape_string($con, $_POST['mdp']));
    
        $query = "SELECT * FROM membre WHERE pseudo = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $membre_pseudo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $membre_data = mysqli_fetch_assoc($result);
    
        if ($membre_data) {
            if (password_verify($membre_mdp, $membre_data['mdp'])) {
                $_SESSION['membre_pseudo'] = $membre_pseudo;
                $_SESSION['membre_statut'] = $membre_data['statut'];
                $_SESSION['membre_id'] = $membre_data['id_membre'];
    
                echo "<script>alert('Logged in!!')</script>";
                echo "<script>window.open('./salles.php', '_self')</script>";
                exit();
            } else {
                echo "<script>alert('Mot de passe incorrect')</script>";
            }
        } else {
            echo "<script>alert('Pseudo incorrect')</script>";
        }
    }
    
}
?>

<head>
    <title>Login | Lokisalle</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div id="content">
    <div class="container">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2><span> L</span>ogin</h2>
                </div>

                <form method="post">
                    <div class="form-group">
                        <label>Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" required>
                    </div>
                    <div class="form-group">
                        <label>Mot de Passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>
                    <div class="text-center">
                        <button name="login" value="Login" class="btn btn-primary">Connexion</button>
                    </div>
                </form>

                <center>
                    <a id="inscrire" href="./membre_register.php"><h4>S'inscrire ici</h4></a>
                </center>
            </div>
        </div>
    </div>
</div>

<?php require("./includes/footer.php") ?>
</body>
</html>

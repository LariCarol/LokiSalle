<?php
session_start();
require_once("includes/connection.inc.php");
require_once("includes/head.php");
require_once("includes/functions.php");
require_once("includes/main.php");

?>

<div id="content">
    <div class="container">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2><span> S</span>'inscrire</h2>
                </div>

                <form action="./includes/enregistrer_membre.inc.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" required>
                    </div>
                    <div class="form-group">
                        <label>Mot de Passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" class="form-control" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="c_email" placeholder="exemple@gmail.com" required>
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
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require("includes/footer.php") ?>

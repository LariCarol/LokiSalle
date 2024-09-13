<body>    
<header>
    <div class="profile">
        <div class="logo-lg">
            <a href="./index.php#banniere" class="logo"><span>L</span>okiSalle</a>
        </div>
        <?php
            if(!isset($_SESSION['membre_pseudo'])){
                echo '<a href="membre_register.php"><button class="btn btn-primary">S\'inscrire</button></a>';
            } else { 
                echo '<a href="mon_compte.php"><button class="btn btn-primary">Compte</button></a>';
            }   
        ?> 
        <?php
            if(!isset($_SESSION['membre_pseudo'])){
                echo '<a href="membre_login.php"><button class="btn btn-primary">Se connecter</button></a>';
            } else { 
                echo '<a href="includes/logout.inc.php"><button class="btn btn-primary">Se déconnecter</button></a>';
            }   
        ?> 
        <?php
            if(isset($_SESSION['membre_statut']) && $_SESSION['membre_statut'] === 1){
                echo '<a href="gestion_salles.php"><button class="btn btn-secondary">Gestion de salles</button></a>';
                echo '<a href="gestion_produits.php"><button class="btn btn-secondary">Gestion de produits</button></a>';
                echo '<a href="gestion_membres.php"><button class="btn btn-secondary">Gestion de membres</button></a>';
                echo '<a href="gestion_avis.php"><button class="btn btn-secondary">Gestion d\'avis</button></a>';
            }
        ?>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="logo-sm">
            <a href="./index.php#banniere" class="logo">LokiSalle</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
            <ul class="navbar-nav">
                <li><a href="./index.php#apropos">À propos</a></li>
                <li><a href="./salles.php">Salles</a></li>
                <li><a href="./index.php#temoignage">Avis</a></li>
                <li><a href="./index.php#contact">Contact</a></li>
                <li><a id="cart" href="cart.php"></a></li>
            </ul>
        </div>
    </nav> 
</header>


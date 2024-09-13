<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once("includes/connection.inc.php");
require_once("includes/head.php");
require_once("includes/functions.php");
require_once("includes/main.php");
?>
<section class="banniere" id="banniere">
    <div class="contenu">
        <h2>Bienvenus chez LokiSalle</h2>
        <p>Votre plateforme de location de salles pour tous vos événements !</p>
       
        
    </div>
</section>
<!--fin page d acceuil-->
<section class="apropos" id="apropos">
   <div class="row">
        <div class="col50">
            <h2 class="titre-texte"><span>A</span> Propos De Nous</h2>
               <h3>Que vous organisiez une réunion d'affaires, une conférence, un atelier ou une réception privée, 
                LokiSalle vous propose une large gamme de salles adaptées à vos besoins. 
                Grâce à notre site convivial, trouvez facilement l'espace parfait, que ce soit pour un petit séminaire 
                ou un grand événement.
                Nous nous engageons à vous offrir un service personnalisé et des options flexibles pour garantir le succès de votre événement.</h3> 
              
        </div>
       <div id="img-apropos" class="col50">
            <div class="img">
                <img src="./images/evemente_entreprise.jpg" alt="image">
            </div>
        </div>
    </div>
</section>
<!--fin page apropos-->
<!--page  produits -->
<section class="produits" id="produits">
    <div class="titre">
        <h2 class="titre-texte"><span>Salles</h2>
    </div>
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>
  
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/salle_monet.jpg" alt="" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="images/salle_rubens.jpg" alt="" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="images/salle_duchamp.jpg" alt="" class="d-block w-100">
      </div>
    </div>
  
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  <div class="plus">
      <a href="products.php" class="btn1">Voir Plus</a>
  </div>
</section>
<!---fin page produits-->
<!---page temoignage-->
<section class="temoignage" id="temoignage">
    <div class="titre blanc">
        <h2 class="titre-texte">Que Disent Nos <span>C</span>lients</h2>
    </div>
    <div class="contenu">
        <div class="box">
            <div class="imbox">
                <img src="./images/photo_avis_4.png" alt="">
            </div>
            <div class="text">
                <p>"Nous avons organisé une journée de team building et tout a été parfait. L’emplacement est central, le lieu est lumineux, bien aménagé, et l'accueil a été très chaleureux."</p>
                <h3>Warren Buffett</h3>
            </div>
        </div>
        <div class="box">
            <div class="imbox">
                <img src="./images/photo_avis.png" alt="">
            </div>
            <div class="text">
                <p>"Excellent service, la 
                    salle de réunion 
                    était parfaitement 
                    équipée et confortable, 
                    idéale pour nos 
                    besoins professionnels."
                </p>
                <h3>MARIO VERGARA </h3>
            </div>
        </div>
        <div class="box">
            <div class="imbox">
                <img src="./images/photo_avis_3.png" alt="">
            </div>
            <div class="text">
                <p>"La salle est spacieuse, équipée d’un excellent matériel audiovisuel et la connexion Wi-Fi était impeccable. L'équipe sur place a été réactive et professionnelle."</p>
                <h3> ARIANNA HUFFINGTON</h3>
            </div>
        </div>
        <div class="box">
            <div class="imbox">
                <img src="./images/photo_avis_2.png" alt="">
            </div>
            <div class="text">
                <p>"Un lieu idéal pour notre événement d’entreprise, alliant modernité, confort et service impeccable."</p>
                <h3>James Dyson</h3>
            </div>
        </div>
    </div>
 </section>
 <!---fin page de temoignage-->

<!-- page contact -->
<section class="contact" id="contact">
    <div class="titre noir">
        <h2 class="titre-text" id="color"><span>C</span>ontact</h2>
    </div>
    <div class="contactform">
        <form action="">
           <h3>Envoyer un message</h3>
           <input type="text" placeholder="Nom" class="inputboite">
           <input type="text" placeholder="email" class="inputboite">
           <textarea placeholder="message" class="inputboite"></textarea>
           <input type="submit" value="envoyer" class="inputboite">
        </form>
    </div>
</section>
<?php include "includes/footer.php" ?>
</body>
</html>

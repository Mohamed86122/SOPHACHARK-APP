<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>A propos</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="shortcut icon" href="images/Hanover.png" type="image/x-icon">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="./assets/fontawesome-free-6.4.0-web/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/Hanover.png" alt="">
      </div>

      <div class="content">
         <h3>SOPHACHARK</h3>
         <p>La société pharmaceutique du Maghreb Ach-charki (SOPHACHARK S.A) est spécialisée dans la commercialisation de produits pharmaceutiques auprès des pharmacies agréées par le ministère de la Santé.</p>
         <a href="contact.php" class="btn">contactez nous !</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">Feedbacks des clients</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/pic-1.png" alt="">
         <p>Je suis extrêmement satisfait du service de logistique pharmaceutique que j'ai reçu de votre entreprise. Les médicaments que j'ai commandés sont arrivés rapidement et en parfait état. Votre processus de commande en ligne était simple et pratique. Je vous recommande vivement à tous ceux qui ont besoin d'une livraison fiable et rapide de médicaments</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Khalil</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-2.png" alt="">
         <p>En tant que professionnel de la santé, je suis constamment à la recherche d'un partenaire logistique de confiance pour approvisionner mes patients en médicaments. Votre entreprise de logistique pharmaceutique a dépassé toutes mes attentes. Votre équipe est compétente, votre entrepôt est bien organisé et vos délais de livraison sont remarquables. Je vous remercie pour votre excellent service.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>ghizlane</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="">
         <p>Je suis tellement reconnaissant d'avoir trouvé votre site de logistique pharmaceutique. La livraison de médicaments est un élément crucial de ma santé et je peux toujours compter sur vous pour livrer mes médicaments à temps. Votre site est convivial, votre service client est réactif et votre engagement envers la qualité est évident. Je suis un client fidèle et je vous recommande à tous.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>hamid</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-4.png" alt="">
         <p>Je suis impressionné par la précision et l'efficacité de votre service de logistique pharmaceutique. Les médicaments que j'ai commandés ont été soigneusement emballés et sont arrivés dans les délais prévus. Votre site propose également une vaste gamme de produits pharmaceutiques, ce qui facilite grandement la recherche des médicaments dont j'ai besoin. Merci pour votre excellent travail !</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nada</h3>
      </div>

      
   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
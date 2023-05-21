<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="shortcut icon" href="images/logo1.png" type="image/x-icon">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/logo1.png" alt="">
         </div>
         <div class="content">
            <span>SOPHA CHARK</span>
            <h3>Société de logistique pharmaceutique</h3>
            <a href="shop.php" class="btn">Voir les médicaments</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/logo1.png" alt="">
         </div>
         <div class="content">
            <span>La société pharmaceutique du Maghreb Ach-charki (SOPHACHARK S.A) est spécialisée dans la commercialisation de produits pharmaceutiques auprès des pharmacies agréées par le ministère de la Santé. </span>
            <h3>SOPHA CHARK</h3>
            <a href="shop.php" class="btn">Voir les médicaments</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/logo1.png" alt="">
         </div>
         <div class="content">
            <span>SOPHACHARK est une société anonyme créée en 1984 avec un capital de 3 000 000 de dirhams. Elle est située dans la zone industrielle de la route de MAGHNIYA à OUJDA et emploie jusqu'à 50 personnes.</span>
            <h3>SOPHA CHARK</h3>
            <a href="shop.php" class="btn">Voir les médicaments</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">Les médicaments</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=laptop" class="swiper-slide slide">
      <img src="images/anes.png" alt="">
      <h3>ANESTHÉSIQUES</h3>
   </a>

   <a href="category.php?category=tv" class="swiper-slide slide">
      <img src="images/doly.jpeg" alt="">
      <h3>ANALGÉSIQUES</h3>
   </a>

   <a href="category.php?category=camera" class="swiper-slide slide">
      <img src="images/antidote.png" alt="">
      <h3>ANTIDOTES</h3>
   </a>

   <a href="category.php?category=mouse" class="swiper-slide slide">
      <img src="images/antimigraineux.png" alt="">
      <h3>ANTIMIGRAINEUX</h3>
   </a>

   <a href="category.php?category=fridge" class="swiper-slide slide">
      <img src="images/arton.jpg" alt="">
      <h3>ANTICONVULSIVANTS</h3>
   </a>

   <a href="category.php?category=washing" class="swiper-slide slide">
      <img src="images/anaphylaxie.jpg" alt="">
      <h3>ANTI-ANAPHYLACTIQUES</h3>
   </a>

   <a href="category.php?category=smartphone" class="swiper-slide slide">
      <img src="images/1372085.jpg" alt="">
      <h3>ANTIPARKINSONIENS</h3>
   </a>

   <a href="category.php?category=watch" class="swiper-slide slide">
      <img src="images/Nurodol.png" alt="">
      <h3>ANTI-INFLAMMATOIRES</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">latest products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
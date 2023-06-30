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
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="./assets/fontawesome-free-6.4.0-web/css/all.min.css">
   <link rel="shortcut icon" href="images/Hanover.png" type="image/x-icon">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">Commande</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Veuillez se connecter pour passer votre commande !!</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>placé en  : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>numéro de télephone : <span><?= $fetch_orders['number']; ?></span></p>
      <p>adresse : <span><?= $fetch_orders['address']; ?></span></p>
      <p>méthode de paiement : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Votre commande : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Prix total : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p> Statut de paiement : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Aucune commande !</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
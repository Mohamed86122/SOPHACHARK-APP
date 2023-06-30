<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'le statue de paiement est modifié';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commande passée</title>
   <link rel="shortcut icon" href="../images/Hanover.png" type="image/x-icon">
   <link rel="stylesheet" href="./assets/fontawesome-free-6.4.0-web/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">Commande passée</h1>

<div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> passée en  : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Nom : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Numéro de télephone : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> adress : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> total medicaments : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> prix total : <span><?= $fetch_orders['total_price']; ?> MAD</span> </p>
      <p> methode de paiement: <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="completed">Confirmé </option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Supprimer cette commande');">Supprimer</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Aucune commande passée pour le moment !</p>';
      }
   ?>

</div>

</section>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>
<?php

include '../components/connect.php';

session_start();
if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
} else {
   header('location:admin_login.php');
   exit; 
}

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_SPECIAL_CHARS);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_SPECIAL_CHARS);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_SPECIAL_CHARS);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'Médicament déjà existant !';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'Nouveau médicament ajouté ! ';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Médicaments</title>
      <link rel="shortcut icon" href="../images/Hanover.png" type="image/x-icon">
      <link rel="stylesheet" href="./assets/fontawesome-free-6.4.0-web/css/all.min.css">

      <link rel="stylesheet" href="../css/admin_style.css">

   </head>
   <body>

   <?php include '../components/admin_header.php'; ?>

   <section class="add-products">

      <h1 class="heading">Ajouter médicament</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Nom médicament (Obligatoire)</span>
               <input type="text" class="box" required maxlength="100" placeholder="Entrer le nom du médicament" name="name">
            </div>
            <div class="inputBox">
               <span>Prix (Obligatoire)</span>
               <input type="number" min="0" class="box" required max="9999999999" placeholder="Entrer le prix du produit" onkeypress="if(this.value.length == 10) return false;" name="price">
            </div>
         <div class="inputBox">
               <span>image 01 (Obligatoire)</span>
               <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
         </div>
         <div class="inputBox">
               <span>image 02 (Obligatoire)</span>
               <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
         </div>
         <div class="inputBox">
               <span>image 03 (Obligatoire)</span>
               <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
         </div>
            <div class="inputBox">
               <span>Description médicament (Obligatoire)</span>
               <textarea name="details" placeholder="Entrer la description du médicament" class="box" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
         </div>
         
         <input type="submit" value="Ajouter un produit" class="btn" name="add_product">
      </form>

   </section>

   <section class="show-products">

      <h1 class="heading">Produit ajouté</h1>

      <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
      <div class="box">
         <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="price"><span><?= $fetch_products['price']; ?></span> MAD</div>
         <div class="details"><span><?= $fetch_products['details']; ?></span></div>
         <div class="flex-btn">
            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Modifier</a>
            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Voulez-vous supprimer ce médicaments');">Supprimer</a>
         </div>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">Aucun produit ajouté pour le moment !</p>';
         }
      ?>
      
      </div>
   </section>








   <script src="../js/admin_script.js"></script>
      
   </body>
   </html>
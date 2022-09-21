<?php
session_start();
if (array_key_exists('username_client_connected', $_SESSION) && array_key_exists('name_client_connected', $_SESSION)){ 
   $user_connected = $_SESSION['username_client_connected'];
   include "../db_connection/db_conn.php";
   $sql = "SELECT * FROM client WHERE username_client = '$user_connected'";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $nom_client = $row['name_client'];
   $email_client = $row['email_client'];
}else{
   $nom_client = "";
   $email_client = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>
   <link rel="shortcut icon" href="../images/favicon.ico">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/index.css">
   <link rel="stylesheet" href="../css/contact.css">
   <script src="../js/script.js"></script>
   <script src="../js/searchScript.js"></script>
   <style>
      .user{
         margin-right: .5rem;
      }

      #cart{
         cursor: pointer;
         width: 10rem;
         height: 10rem;
         position: fixed;
         bottom: 2rem;
         right: 2rem;
         display: flex;
         flex-direction: column;
         justify-content : center;
         align-items: center;
         animation: Move 2s infinite;
      }

      #cart button{
         color: white;
         background-color: #cd313b;
         width: 3rem;
         height: 3rem;
         border : none;
         border-radius: 50%;
         position: absolute;
         top: 1rem;
         right: 1rem;
         z-index: 1000;
      }

      .fa-cart-shopping{
         color: white;
         background-color: #5cb85c;
         padding: 2rem;
         font-size: 2rem;
         border: none;
         border-radius: 50%;
      }

      .error , .success{
         text-align: center;
         background-color: white;
         align-self: center;
         width: 100%;
         padding: 1rem;
         font-weight : 500;
         margin-top: 2rem;
      }
      .error{
         color: #cd313b;
      }

      .success{
         color: #5cb85c;
         
      }

      /* key frames */
      @keyframes Move {
         0% { transform: translate(0 ,0);}
         20% { transform: translate(0 ,-.6rem);}
         40% { transform: translate(0 ,.6rem);}
         60% { transform: translate(0 ,-.6rem);}
         80% { transform: translate(0 ,.6rem);}
         100% { transform: translate(0 ,0);}
      }
   </style>
</head>
<body>

   <nav>
      <div class="logo">
         <label for=""><i class="fa-solid fa-gear"></i> YOUR <span>DEVICE</span></label>
      </div>
      
      <div class="menu_and_search">
         
         <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a class="login" href="listLaptops.php">Laptops</a></li>
            <li><a class="login" href="listPhones.php">Phones</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="index.php#popular">Popular</a></li>
            <li>
               <?php if (array_key_exists('username_client_connected', $_SESSION) && array_key_exists('name_client_connected', $_SESSION)){ ?>
                  <a class="login" href="client_profile.php"><i class="fa-solid fa-user user"></i><?php echo $_SESSION['name_client_connected'] ?></i></a>
               <?php }else{
                  session_unset();
                  session_destroy();
               ?>
                  <a class="login" href="clientLogin.php">Login<i class="fa-solid fa-right-to-bracket"></i></a>
               <?php } ?>
            </li>
         </ul>

         <div class="search">
            <form action="searchPage.php" method="GET">
               <input type="text" name="search_text" id="search" placeholder="search">
               <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div id="list">
               
            </div>
         </div>
         
      </div>
      <i id="menuIcon" class="fa-solid fa-bars"></i>
   </nav>

   <section class="container">
      <div class="image">
         <img src="../images/contact-01.svg" alt="image">
      </div>
      <div class="form">
         <form action="contactUsController.php" method="post" class="contactUs">
            <h1>Contact Us</h1>
            <label>Full name :</label>
            <input type="text" name="name_client" value="<?php echo $nom_client ?>" id="name_client" required>
            <label>Your Email :</label>
            <input type="email" name="email_client" value="<?php echo $email_client ?>" id="email_client" required>
            <label>Your Message :</label>
            <textarea name="client_message" id="client_message" rows="5" required></textarea>
            <button type="submit">Send</button>

            <?php
               if(isset($_GET['error'])){
            ?>
            <p class="error"><?php echo $_GET['error'] ?></p>
            <?php } ?>

            <?php
               if(isset($_GET['success'])){
            ?>
            <p class="success"><?php echo $_GET['success'] ?></p>
            <?php } ?>

         </form>
      </div>
      
   </section>

   <section class="footer">

      <div class="box-container">

         <div class="box" id="contact">
            <h3>contact info</h3>
            <a href="#"><i class="fas fa-phone"></i> +212 600 000 000 </a>
            <a href="#"><i class="fas fa-envelope"></i> ouremailaddress@gmail.com </a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> Country , CITY - POSTAL CODE </a>
         </div>

         <div class="box">
            <h3>follow us</h3>
            <a target="_blank" href="#"><i class="fab fa-facebook-f"></i> facebook </a>
            <a target="_blank" href="#"><i class="fab fa-instagram"></i> instagram </a>
            <a target="_blank" href="#"><i class="fab fa-linkedin"></i> linkedin </a>
         </div>

         <div class="box">
            <img src="../images/pub-footer.gif" alt="pub-footer">
         </div>

         <div class="box">
            <img src="../images/pub-footer2.gif" alt="pub-footer">
         </div>

      </div>

      <div class="credit"><i class="fa-solid fa-gear"></i> YOUR DEVICE | <span>All rights reserved </span><span id="year"></span> </div>

   </section>

   <?php if (array_key_exists('username_client_connected', $_SESSION) && array_key_exists('name_client_connected', $_SESSION)){
      $username_client = $_SESSION['username_client_connected'];
      include "../db_connection/db_conn.php";
      $sql="SELECT * FROM client WHERE username_client = '$username_client'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $id_client = $row['id_client'];

      $sql2 = "SELECT * FROM cart WHERE id_client = '$id_client'";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute();

      $number = 0;
      while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
         $number = $number + 1;
      }
      
   ?>
   
      <a href="client_profile.php"><div id="cart">
      <?php if($number != 0){?><button><?php echo $number; ?></button><?php } ?>
         <i class="fa-solid fa-cart-shopping"></i>
      </div></a>

   <?php } ?>
   
</body>
</html>
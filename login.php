<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   } else {
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="./style/style.css">
   <link rel="icon" href="./images/online-learning.png">
   <title>login</title>
   <style>
      .form-container {
         min-height: 90vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding: 20px;
      }
      ::-webkit-scrollbar {
         width: 10px;
      }
      ::-webkit-scrollbar-thumb {
         background: #C8C8C8; 
         border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb:hover {
         background: #A7A7A7; 
      }
   </style>
</head>

<body>

   <div class="form-container">

      <form action="" method="post" enctype="multipart/form-data">
         <h1>Login now</h1><br>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <div class="form-group">
            <input type="email" name="email" placeholder="enter email" class="box" required>
         </div>
         <div class="form-group">
            <input type="password" name="password" placeholder="enter password" class="box" required>
         </div>
         <div class="form-group">
            <input type="submit" name="submit" value="login now" class="btn btn-primary">
         </div>
         <p>don't have an account? <a href="register.php">regiser now</a></p>
      </form>

   </div>

</body>

</html>
<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
      if ($update_pass != $old_pass) {
         $message[] = 'old password not matched!';
      } elseif ($new_pass != $confirm_pass) {
         $message[] = 'confirm password not matched!';
      } else {
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
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
   <title>update profile</title>
   <style>
      .update-profile {
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

   <div class="update-profile">

      <?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select) > 0) {
         $fetch = mysqli_fetch_assoc($select);
      }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <div class="form-group">
            <h1>Update now</h1><br>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
         </div>

         <div class="form-group">
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
         </div>

         <div class="form-group">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
         </div>

         <div class="form-group">
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
         </div>

         <div class="form-group">
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
         </div>

         <div class="form-group">
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>

         <input type="submit" value="update profile" name="update_profile" class="btn btn-primary">
         <a href="home.php" class="delete-btn">go back</a>
      </form>

   </div>

</body>

</html>
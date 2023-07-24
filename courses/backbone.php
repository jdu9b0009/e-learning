<?php

include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
};

if (isset($_GET['logout'])) {
  unset($user_id);
  session_destroy();
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>BackboneJS</title>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../style/courses.css">
  <link rel="icon" href="../images/online-learning.png">
  <style>
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

  <!-- ナビゲーションバー -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    
  <div class="container" style="padding-top: 15px;">
      <div class="profile">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select) > 0) {
          $fetch = mysqli_fetch_assoc($select);
        }
        ?>
        <h3>
          <?php echo $fetch['name']; ?>
        </h3>
        <a href="../update_profile.php">update profile</a>
        <a href="../home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
        <p>new <a href="../login.php">login</a> or <a href="../register.php">register</a></p>
      </div>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../home.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../home.php">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../home.php">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Aboutページ -->
  <section id="about">
      <div class="container">
          <h2>What is Backbone.js?</h2>
          <p>
            Backbone.js is a library you can include on your web page with a 
            single script tag. This front-end-oriented JavaScript library helps 
            you add interactivity, such as event handling, to static HTML pages 
            in a scalable fashion.
          </p> 
          <p>
            Unlike other JavaScript libraries, such as Vue.js, Backbone.js acts 
            as a…well…backbone to your JavaScript app by giving you ready-made 
            models, views, collections and events.
            Even though Backbone.js is a front-end library, it has some 
            helpful back-end features for using APIs. For example, you can 
            create, read, update and delete records from a database.
          </p>
      </div>
  </section>

  <!-- Coursesページ -->
  <section id="courses">
    <div class="container">
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 1">
            <div class="card-body">
              <h5 class="card-title">Lesson 1</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 2">
            <div class="card-body">
              <h5 class="card-title">Lesson 2</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Lesson 3</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 4">
            <div class="card-body">
              <h5 class="card-title">Lesson 4</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 5">
            <div class="card-body">
              <h5 class="card-title">Lesson 5</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 6">
            <div class="card-body">
              <h5 class="card-title">Lesson 6</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 7">
            <div class="card-body">
              <h5 class="card-title">Lesson 7</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 8">
            <div class="card-body">
              <h5 class="card-title">Lesson 8</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="../images/course7.jpg" class="card-img-top" alt="Course 9">
            <div class="card-body">
              <h5 class="card-title">Lesson 9</h5>
              <a href="../lessons/lesson.php" class="btn btn-primary">view lesson</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../script/script.js"></script>
</body>

</html>
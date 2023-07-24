<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}
;

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
  <link rel="stylesheet" href="./style/style.css">
  <link rel="icon" href="./images/online-learning.png">
  <title>e-Learning</title>
  <style>
    /* ダークモード */
    body {
      transition: background-color 0.3s;
    }

    .bg-dark-mode {
      cursor: pointer;
      background-color: #333;
      color: #fff;
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
    
    /* カルーセル */
    .carousel-container {
      position: relative;
      overflow: hidden;
      width: 100%;
      height: 60%;
    }

    .carousel-slide {
      display: flex;
      width: 100%;
      height: 100%;
    }

    .carousel-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .prev-btn, .next-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      padding: 8px 16px;
      border: none;
      background-color: #333;
      color: #fff;
      cursor: pointer;
    }

    .prev-btn {
      left: 0;
    }

    .next-btn {
      right: 0;
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
        <a href="update_profile.php">update profile</a>
        <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
        <p>new <a href="login.php">login</a> or <a href="register.php">register</a></p>
      </div>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#courses">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li>
          <img id="darkModeToggle" onclick="toggleDarkMode()" width="40" height="40"
            src="https://img.icons8.com/ios/100/day-and-night.png" alt="day-and-night" />
        </li>
      </ul>
    </div>

  </nav>

  <!-- ホームページ -->
  <section id="home">
    <div class="container">
      <h1>Welcome to the e-Learning Platform!</h1>
      <p>Learn at your own pace with our online courses.</p>
    </div>
  </section>

  <!-- Aboutページ -->
  <section id="about">
    <div class="container">
      <h2>About Us</h2>
      <p>
        Introducing our e-learning platform, a comprehensive hub for mastering 
        modern web development technologies. Whether you're a beginner looking 
        to dive into the world of web development or an experienced developer 
        seeking to expand your skillset, our platform offers a wide range of 
        courses to cater to your learning needs.
      </p><br />
      <div class="carousel-container">
        <div class="carousel-slide">
          <img src="./images/background1.png" alt="Image 1">
          <img src="./images/background2.png" alt="Image 2">
          <img src="./images/background3.png" alt="Image 4">
          <img src="./images/background4.png" alt="Image 5">
          <img src="./images/background5.png" alt="Image 6">
          <img src="./images/background7.png" alt="Image 7">
        </div>
        <button class="prev-btn btn btn-primary">←</button>
        <button class="next-btn btn btn-primary">→</button>
    </div>
    </div>
  </section>

  <!-- Coursesページ -->
  <section id="courses">
    <div class="container">
      <h2>Our Courses</h2>
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course1.jpg" class="card-img-top" alt="Course 1">
            <div class="card-body">
              <h5 class="card-title">Course 1</h5>
              <p class="card-text">Learn React JS</p>
              <a href="./courses/react.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course2.jpg" class="card-img-top" alt="Course 2">
            <div class="card-body">
              <h5 class="card-title">Course 2</h5>
              <p class="card-text">Learn Next JS</p>
              <a href="./courses/next.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course3.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 3</h5>
              <p class="card-text">Learn Vue JS</p>
              <a href="./courses/vue.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course4.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 4</h5>
              <p class="card-text">Learn Node JS</p>
              <a href="./courses/node.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course5.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 5</h5>
              <p class="card-text">Learn Angular JS</p>
              <a href="./courses/angular.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course6.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 6</h5>
              <p class="card-text">Learn Meteor JS</p>
              <a href="./courses/meteor.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course7.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 7</h5>
              <p class="card-text">Learn Backbone JS</p>
              <a href="./courses/backbone.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course8.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 8</h5>
              <p class="card-text">Learn Aurelia JS</p>
              <a href="./courses/aurelia.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <img src="./images/course9.jpg" class="card-img-top" alt="Course 3">
            <div class="card-body">
              <h5 class="card-title">Course 9</h5>
              <p class="card-text">Learn Ember JS</p>
              <a href="./courses/ember.php" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Contactページ -->
  <section id="contact">
    <div class="container">
      <h2>Contact Us</h2>
      <form action="submit_form.php" method="POST">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="message">Message:</label>
          <textarea class="form-control" id="message" name="message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="./script/script.js"></script>
  <script>
    // カルーセル
    const carouselSlide = document.querySelector('.carousel-slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    let slideIndex = 0;

    prevBtn.addEventListener('click', () => {
      slideIndex = (slideIndex === 0) ? carouselSlide.children.length - 1 : slideIndex - 1;
      updateSlide();
    });

    nextBtn.addEventListener('click', () => {
      slideIndex = (slideIndex === carouselSlide.children.length - 1) ? 0 : slideIndex + 1;
      updateSlide();
    });

    function updateSlide() {
      carouselSlide.style.transform = `translateX(-${slideIndex * 100}%)`;
    }

    // ダークモード
    function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');
    }
  </script>
</body>

</html>
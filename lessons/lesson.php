<?php

include '../config.php';
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
  <title>Lesson</title>
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

    .comment-style {
      background-color: #fff;
      border-radius: 10px;
      border: 1px solid #ced4da;
      padding:20px;
      padding-bottom: 30px;
    }

    video {
      padding-bottom: 20px;
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

  <!-- Lessonページ -->
  <section id="courses">
    <div class="container">
      <video width="100%" height="80%" controls>
        <source src="../images/vid-1.mp4" type="video/mp4">
      </video>
      <div class="card-body">
        <!-- コメントフォーム -->
        <form action="../comment/submit_comments.php" method="POST">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" name="comment" id="comment" required></textarea>
          </div>
          <button type="submit" id="comment" class="btn btn-primary">Submit Comment</button>
        </form>
        <h2>Comment</h2>
        <?php
        // MySQLへの接続情報
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "user_db";

        // MySQLへの接続
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // コメントの表示
        $sql = "SELECT * FROM comments";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // コメントを表示
          while ($row = $result->fetch_assoc()) {
            echo "<div class='comment-style'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<p>" . $row["comment"] . "</p>";
            echo "<a href='lesson.php?action=edit&id=" . $row["id"] . "'>Edit</a> | ";
            echo "<a href='lesson.php?action=delete&id=" . $row["id"] . "'>Delete</a>";
            echo "</div><br>";
          }
        } else {
          echo "No comments yet.";
        }

        // 編集・削除の処理
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
          if (isset($_GET["action"]) && isset($_GET["id"])) {
            $action = $_GET["action"];
            $id = $_GET["id"];

            // MySQLへの接続はここで再度行う必要があります
        
            if ($action === "edit") {
              // 編集フォームを表示
              $sql = "SELECT * FROM comments WHERE id='$id'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row["name"];
                $comment = $row["comment"];
                echo "<br><br><form action='lesson.php?action=update&id=" . $id . "' method='post'>";
                echo "<input type='hidden' name='id' value='" . $id . "'>";
                echo "<label for='name'>Name:</label>";
                echo "<input class='form-control' type='text' id='name' name='name' value='" . $name . "' required>";
                echo "<br>";
                echo "<label for='comment'>Comment:</label>";
                echo "<textarea class='form-control' id='comment' name='comment' required>" . $comment . "</textarea>";
                echo "<br>";
                echo "<button type='submit' class='btn btn-primary'>Update</button>";
                echo "</form>";
              } else {
                echo "Comment not found.";
              }
            } elseif ($action === "delete") {
              // コメントの削除処理
              $sql = "DELETE FROM comments WHERE id='$id'";
              if ($conn->query($sql) === TRUE) {
                header("Location: lesson.php");
                exit();
              } else {
                echo "Error deleting comment: " . $conn->error;
              }
            }
          }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
          // POSTリクエストの場合はUPDATE処理を行う
          if (isset($_GET["action"]) && $_GET["action"] === "update") {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $sql = "UPDATE comments SET name='$name', comment='$comment' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
              header("Location: lesson.php");
              exit();
            } else {
              echo "Error updating comment: " . $conn->error;
            }
          }
        }

        // MySQL接続を閉じる
        $conn->close();
        ?>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../script/script.js"></script>
</body>

</html>
<?php
// レッスンのコメント //
require_once 'config.php';

// フォームからのデータ取得
if (isset($_POST['name']) && isset($_POST['comment'])) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    // データベースにデータを挿入
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";

    if ($conn2->query($sql) === TRUE) {
        header("Location: ./lessons/lesson.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn2->error;
    }
}

// データベース接続を閉じる
$conn2->close();


// ホームのコンタクト //
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // MySQLへの接続情報
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_db";

    // MySQLへの接続
    $conn = new mysqli("localhost", "root", "", "user_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // データの挿入
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // MySQL接続を閉じる
    $conn->close();
}

?>
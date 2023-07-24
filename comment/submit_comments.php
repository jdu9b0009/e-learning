<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // データの挿入
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
    if ($conn->query($sql) === TRUE) {
        // フォームに戻るためのリダイレクト
        header("Location: ../lessons/lesson.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // MySQL接続を閉じる
    $conn->close();
}
?>

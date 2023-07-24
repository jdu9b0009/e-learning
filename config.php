<?php

// サインインとサインアップ
$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');


// データベース接続
$conn2 = new mysqli('localhost','root','','user_db');
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

?>
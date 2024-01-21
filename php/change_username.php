<?php
session_start();
include_once "db.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);

if (isset($_SESSION['id'])) {
    if (!empty($username)) {
        $success = true;
        $id = $_SESSION['id'];
        $sql = mysqli_query($conn, "SELECT username FROM user WHERE username = '{$username}'");

        if (mysqli_num_rows($sql) > 0) {
            echo "<p>The username $username already exists.</p>";
            $success = false;
        }

        if (!preg_match("#^[a-zA-Z0-9_]+$#", $username)) {
            echo "<p>Usernames can only contain letters, numbers and underscores.</p>";
            $success = false;
        }

        if (strlen($username) >= 35) {
            echo "<p>Usernames can't be longer than 35 characters.</p>";
            $success = false;
        }

        if ($success == true) {
            $sql1 = mysqli_query($conn, "UPDATE `user` SET `username` = '{$username}' WHERE `user`.`id` = {$id} ");
            $_SESSION['username'] = $username;
            echo "success";
        }
    } else {
        echo "<p>All input fields are required.</p>";
    }
} else {
    echo "<p>User not logged in.</p>";
}

<?php
session_start();
include_once "db.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

if (!empty($username) && !empty($password) && !empty($confirmPassword)) {
    $success = true;
    $sql = mysqli_query($conn, "SELECT username FROM user WHERE username = '{$username}'");

    if (mysqli_num_rows($sql) > 0) {
        echo "<p>The username $username already exists.</p>";
        $success = false;
    }
    if (strlen($password) < 8) {
        echo "<p>Password must be more than 8 characters long.</p>";
        $success = false;
    }
    if ($password != $confirmPassword) {
        echo "<p>Passwords don't match.</p>";
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
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = mysqli_query($conn, "INSERT INTO `user` (`id`, `username`, `password`, `color`) VALUES (NULL, '{$username}', '{$hashed_password}', 'blue') ");
        if ($sql2) {
            $sql3 = mysqli_query($conn, "SELECT * FROM user WHERE username = '{$username}'");
            if (mysqli_num_rows($sql3) > 0) {
                $row = mysqli_fetch_assoc($sql3);
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                echo "success";
            }
        } else {
            echo "<p>Something went wrong.</p>";
        }
    }
} else {
    echo "<p>All input fields are required.</p>";
}

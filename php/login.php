<?php
session_start();
include_once "db.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($username) && !empty($password)) {
    $success = false;
    $id = 0;
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '{$username}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $hashed_password = $row['password'];
        if (password_verify($password, $hashed_password)) {
            $success = true;
            $id = $row['id'];
        }
    }

    if ($success == true) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        echo "success";
    } else {
        echo "<p>Username or password is incorrect.</p>";
    }
} else {
    echo "<p>All input fields are required.</p>";
}

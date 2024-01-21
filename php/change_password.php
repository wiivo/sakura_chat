<?php
session_start();
include_once "db.php";
$oldPassword = mysqli_real_escape_string($conn, $_POST['oldPassword']);
$newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

if (isset($_SESSION['id'])) {
    if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)) {
        $success = true;
        $id = $_SESSION['id'];
        $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = '{$id}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $hashed_password = $row['password'];
            if (password_verify($oldPassword, $hashed_password)) {
                if (strlen($newPassword) < 8) {
                    echo "<p>New password must be more than 8 characters long.</p>";
                    $success = false;
                }
                if ($newPassword != $confirmPassword) {
                    echo "<p>Passwords don't match.</p>";
                    $success = false;
                }
            } else {
                echo "<p>Old password is incorrect.</p>";
                $success = false;
            }
        } else {
            echo "<p>Unexpected error.</p>";
            $success = false;
        }

        if ($success == true) {
            $new_hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql1 = mysqli_query($conn, "UPDATE `user` SET `password` = '{$new_hashed_password}' WHERE `user`.`id` = {$id} ");
            echo "success";
        }
    } else {
        echo "<p>All input fields are required.</p>";
    }
} else {
    echo "<p>User not logged in.</p>";
}

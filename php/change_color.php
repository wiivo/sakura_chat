<?php
session_start();
include_once "db.php";
$color = mysqli_real_escape_string($conn, $_POST['color']);

if (isset($_SESSION['id'])) {
    if (!empty($color)) {
        $id = $_SESSION['id'];

        switch ($color) {
            case 'red':
            case 'orange':
            case 'gold':
            case 'green':
            case 'teal':
            case 'blue':
            case 'purple':
            case 'black':
                $sql1 = mysqli_query($conn, "UPDATE `user` SET `color` = '{$color}' WHERE `user`.`id` = {$id} ");
                echo "success";
                break;

            default:
                echo "<p>Invalid color.</p>";
                break;
        }
    } else {
        echo "<p>All input fields are required.</p>";
    }
} else {
    echo "<p>User not logged in.</p>";
}

<?php
$conn = mysqli_connect("localhost", "root", "", "sakura_chat");
if (!$conn) {
    echo "Database connected" . mysqli_connect_error();
}

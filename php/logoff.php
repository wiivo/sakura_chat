<?php
session_start();
if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    echo "success";
} else {
    echo "User is not logged in.";
}

<?php
session_start();
include_once "db.php";
$message = mysqli_real_escape_string($conn, $_POST['message']);

if (isset($_SESSION['id'])) {
    $trimmessage = rtrim(strip_tags($message));
    if (!empty($trimmessage)) {
        $id = $_SESSION['id'];
        if (strlen($trimmessage) < 400) {
            if (substr($trimmessage, 0, 1) === "/") {
                $messagearray = explode(" ", $trimmessage, 3);

                switch ($messagearray[0]) {
                    case "/tell":
                        if (3 != count(array_filter($messagearray, "strlen"))) echo "Invalid syntax: <em>/tell &lt;username&gt; [message]</em>";
                        else {
                            $sql1 = mysqli_query($conn, "SELECT * FROM user WHERE username = '{$messagearray[1]}'");
                            if (mysqli_num_rows($sql1) > 0) {
                                $row = mysqli_fetch_assoc($sql1);
                                $receiverid = $row['id'];
                                $sql = mysqli_query($conn, "INSERT INTO `message` (`id`, `user`, `telluser`, `message`, `timestamp`) 
                        VALUES (NULL, '{$id}', '{$receiverid}', '{$messagearray[2]}', CURRENT_TIMESTAMP)") or die();
                            } else echo "User &apos;{$messagearray[1]}&apos; does not exist.";
                        }
                        break;
                    default:
                        echo "No such chat command exists.";
                }
            } else {
                $sql = mysqli_query($conn, "INSERT INTO `message` (`id`, `user`, `telluser`, `message`, `timestamp`) 
            VALUES (NULL, '{$id}', NULL, '{$trimmessage}', CURRENT_TIMESTAMP)") or die();
            }
        } else {
            echo "Messages cannot be longer than 400 characters.";
        }
    } else {
        echo "You can't submit an empty message.";
    }
} else {
    echo "User not logged in.";
}

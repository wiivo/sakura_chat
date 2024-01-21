<?php
session_start();
include_once "db.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $newest = ($_GET['newest']) ? $_GET['newest'] : 0;
    $sql = mysqli_query($conn, "SELECT `message`.`id`, `user`.`username`, `user`.`color`, `message`.`message`, date_format(`message`.`timestamp`, '%d %b %y - %H:%i'), `message`.`telluser` is not null, `message`.`user` = '{$id}' 
    FROM `user`
        LEFT JOIN `message` ON `message`.`user` = `user`.`id`
    WHERE `message`.`id` > '$newest' and `message`.`message` is not null and ((`message`.`telluser` is null) or (`message`.`telluser` = '{$id}') or (`message`.`user` = '{$id}'))
    ORDER BY `message`.`id` DESC
    LIMIT 15");

    if (mysqli_num_rows($sql) > 0) {
        $data = mysqli_fetch_all($sql);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    } else {
        echo json_encode(array("0"));
    }
} else {
    $jsonarray = array("error" => "ERROR: Tried to fetch messages when not logged in.");
    echo json_encode($jsonarray);
}

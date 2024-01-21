<?php
$loggedin = false;
session_start();
if (isset($_SESSION['id'])) {
    $loggedin = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SakuraChat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/xp.css" />
    <!-- Copyright 2018 Twitter, Inc and other contributors. Graphics licensed under CC-BY 4.0: https://creativecommons.org/licenses/by/4.0/ -->
    <link rel="icon" type="image/png" href="https://favi.deno.dev/🌸.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="window main-window">
        <div class="title-bar">
            <div class="title-bar-text">
                🌸 SakuraChat
            </div>
            <div class="title-bar-controls">
                <button aria-label="Minimize"></button>
                <button aria-label="Maximize"></button>
                <button aria-label="Close"></button>
            </div>
        </div>
        <div class="window-body">
            <div class="menu-bar">
                <div>
                    <span onclick="showUserDropdown(1)">User</span>
                    <div class="dropdown-content">
                        <?php
                        if (!$loggedin) {
                            echo '<p onclick="showWindow(\'#register\')">Register</p>';
                            echo '<p onclick="showWindow(\'#login\')">Login</p>';
                        } else {
                            echo '<p onclick="showWindow(\'#change-color\')">Change Color</p>';
                            echo '<p onclick="showWindow(\'#change-username\')">Change Username</p>';
                            echo '<p onclick="showWindow(\'#change-password\')">Change Password</p>';
                            echo '<p onclick="handleLogOff()">Log off</p>';
                        } ?>

                    </div>
                </div>
                <div>
                    <span onclick="showUserDropdown(2)">Help</span>
                    <div class="dropdown-content">
                        <p>There is no help.</p>
                    </div>
                </div>
            </div>
            <div class="chat-container">
                <ul class="tree-view" id="chat-window">
                    <?php
                    if (!$loggedin) {
                        echo '<div class="message status-message" style="text-align: center;">';
                        echo '<li><strong>Welcome to PotatoChat!</strong></li>';
                        echo '<li>Click on <em>User > Register</em> to sign up for an account. If you already have one, go to <em>User > Login</em> to sign in.</li>';
                        echo '</div>';
                    }
                    ?>
                </ul>
                <?php
                if (!$loggedin) {
                    echo '<form><input disabled placeholder="Please login or register to chat">
                                  <button type="button" disabled style="cursor: default !important">Submit</button></form>';
                } else {
                    echo '<form id="chat-input" method="post">
                            <input name="message" autocomplete="off" placeholder="Type your message here">
                            <button type="submit">Submit</button>
                        </form>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include_once("php/new_windows.php")
    ?>

    <script src="windows.js"></script>
    <script src="formHandling.js"></script>

    <?php
    if ($loggedin) {
        echo "<script>
        (async function () {await getMessages()})()
        .then(() => $('#chat-window').append('<div class=\"message status-message\">'
        + '<li>Welcome back {$_SESSION['username']}! You can use <em>'
        + '/tell &lt;username&gt; [message]</em> to privately message someone.</li></div>'))
        .then(()=>setInterval(getMessages, 500));
        </script>";
    } ?>

</body>

</html>
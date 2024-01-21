let chatWindow = $("#chat-window");

let newestMessageId = "0";
let lastUsername = "";
let wasPrivate = "0";
let lastTimestamp = "";

$("#chat-input").on("submit", (e) => sendMessage(e))
$("#login form").on("submit", (e) => handleNWFormSubmit(e, "php/login.php"))
$("#register form").on("submit", (e) => handleNWFormSubmit(e, "php/register.php"))
$("#change-username form").on("submit", (e) => handleNWFormSubmit(e, "php/change_username.php"))
$("#change-password form").on("submit", (e) => handleNWFormSubmit(e, "php/change_password.php"))
$("#change-color form").on("submit", (e) => handleNWFormSubmit(e, "php/change_color.php"))


async function handleNWFormSubmit(e, url) {
    e.preventDefault();
    const formData = new FormData(e.target)
    await fetch(url, { method: "POST", body: formData })
        .then(response => response.text())
        .then(body => {
            if (body == "success") {
                location.reload();
            }
            else {
                $(".new-window>.window-body p").remove()
                $(".new-window>.window-body").prepend(body);
            }
        })
}

async function sendMessage(e) {
    e.preventDefault();
    const formData = new FormData(e.target)
    await fetch("php/send_message.php", { method: "POST", body: formData })
        .then(response => response.text())
        .then(body => {
            if (body) {
                let message = '<div class="message status-message"><li>';
                message = message + body;
                message = message + '</li></div>';
                chatWindow.append(message)
            }
            if (body != "Messages cannot be longer than 400 characters.") $("#chat-input")[0].reset();
        })
}

async function getMessages() {
    await fetch("php/get_messages.php?newest=" + newestMessageId)
        .then(response => response.json())
        .then(body => {
            if (body?.error) {
                let message = '<div class="message status-message"><li>';
                message = message + body.error;
                message = message + '</li></div>';
                chatWindow.append(message)
                clearInterval(chatInterval);
            }
            else if (body[0] != "0") {
                //0 - message_id
                //1 - username
                //2 - color
                //3 - message
                //4 - timestamp
                //5 - is_for_user
                //6 - is_from_user

                body.filter(m => parseInt(m[0]) > parseInt(newestMessageId))
                    .findLast((m) => {
                        // console.log(m[0])
                        if (lastUsername != m[1] || wasPrivate != m[5] || lastTimestamp != m[4]) {
                            let message = '<div class="message">';
                            message = message + '<li><strong style="color: ' + m[2] + '">';
                            message = message + m[1] + ':&nbsp;&nbsp;</strong><em>' + m[4] + '</em></li></div>';

                            chatWindow.append(message)
                            if (m[5] == '1') $("#chat-window .message:last-child").css("background", "lavender")
                            if (m[6] == '1') $("#chat-window .message:last-child").css("text-align", "right")
                            lastUsername = m[1];
                            wasPrivate = m[5];
                            lastTimestamp = m[4];
                        }

                        $("#chat-window .message:last-child").append('<li>' + m[3] + '</li>');

                        return false;
                    });
                newestMessageId = body[0][0];
            }

        })
}

async function handleLogOff() {
    await fetch("php/logoff.php")
        .then(response => response.text())
        .then(body => {
            if (body == "success")
                location.reload();
            else console.log(body);
        })
}
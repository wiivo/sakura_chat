let isWindowOpen = false;
$("#color").on("change", (e) => changeColorDemo(e))


function showWindow(window) {
    if (isWindowOpen) closeWindow()
    $(window).css("display", "block");
    isWindowOpen = true;
}

function closeWindow() {
    $(".new-window").css("display", "none");
    $(".new-window>.window-body p").remove()
    isWindowOpen = false;
}

function showUserDropdown(number) {
    let dropdown = $('.menu-bar>div:nth-child(' + number + ') .dropdown-content');
    let dropdownDisplay = dropdown.css("display");
    if (dropdownDisplay == "none") {
        $(".menu-bar>div .dropdown-content").css("display", "none");
        dropdown.css("display", "block");
    } else {
        dropdown.css("display", "none");
    }
}

function changeColorDemo(e) {
    $(".change-color strong").css("color", e.target.value);
}
<?php
if (!$loggedin) {
    echo '  <div class="window new-window" id="login">
                    <div class="title-bar">
                        <div class="title-bar-text">
                            Login
                        </div>

                        <div class="title-bar-controls">
                            <button aria-label="Close" onclick="closeWindow()"></button>
                        </div>
                    </div>
                    <div class="window-body">
                        <form method="post">
                            <div class="nw-form-inputs">
                                <label for="username">Username</label>
                                <input type="text" name="username" required>
                                <label for="password">Password</label>
                                <input type="password" name="password" required>
                            </div>
                            <section class="field-row">
                                <button type="submit">OK</button>
                            </section>
                        </form>
                    </div>
                </div>';

    echo '  <div class="window new-window" id="register">
            <div class="title-bar">
                <div class="title-bar-text">
                    Register
                </div>

                <div class="title-bar-controls">
                    <button aria-label="Close" onclick="closeWindow()"></button>
                </div>
            </div>
            <div class="window-body">
                <form method="post">
                    <div class="nw-form-inputs">
                        <label for="username">Username</label>
                        <input type="text" name="username" required>
                        <label for="password">Password</label>
                        <input type="password" name="password" required>
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" required>
                    </div>
                    <section class="field-row">
                        <button type="submit">OK</button>
                    </section>
                </form>
            </div>
        </div>';
} else {
    echo '  <div class="window new-window" id="change-password">
    <div class="title-bar">
        <div class="title-bar-text">
            Change Password
        </div>

        <div class="title-bar-controls">
            <button aria-label="Close" onclick="closeWindow()"></button>
        </div>
    </div>
    <div class="window-body">
        <form method="post">
            <div class="nw-form-inputs">
                <label for="oldPassword">Old Password</label>
                <input type="password" name="oldPassword" required>
                <label for="newPassword">New Password</label>
                <input type="password" name="newPassword" required>
                <label for="confirmPassword">Confirm New Password</label>
                <input type="password" name="confirmPassword" required>
            </div>
            <section class="field-row">
                <button type="submit">OK</button>
            </section>
        </form>
    </div>
</div>';

    echo '  <div class="window new-window" id="change-username">
<div class="title-bar">
    <div class="title-bar-text">
        Change Username
    </div>

    <div class="title-bar-controls">
        <button aria-label="Close" onclick="closeWindow()"></button>
    </div>
</div>
<div class="window-body">
    <form method="post">
        <div class="nw-form-inputs">
            <label for="newUsername">New Username</label>
            <input type="text" name="username" required>
        </div>
        <section class="field-row">
            <button type="submit">OK</button>
        </section>
    </form>
</div>
</div>';

    echo '  <div class="window new-window" id="change-color">
<div class="title-bar">
    <div class="title-bar-text">
        Change Color
    </div>

    <div class="title-bar-controls">
        <button aria-label="Close" onclick="closeWindow()"></button>
    </div>
</div>
<div class="window-body">
    <form method="post">
        <div class="nw-form-inputs">
            <ul class="tree-view change-color">
                <li><strong style="color: red;">' . $_SESSION['username'] . ':&nbsp;&nbsp;</strong><em>13 JAN 24 - 12:38</em></li>
                <li>♫♪.ılılıll|̲̅̅●̲̅̅|̲̅̅=̲̅̅|̲̅̅●̲̅̅|llılılı.♫♪</li>
            </ul>
            <label for="color">Color</label>
            <select name="color" id="color">
                <option value="red">Red</option>
                <option value="orange">Orange</option>
                <option value="gold">Yellow</option>
                <option value="green">Green</option>
                <option value="teal">Teal</option>
                <option value="blue">Blue</option>
                <option value="purple">Purple</option>
                <option value="black">Black</option>
            </select>
        </div>
        <section class="field-row">
            <button type="submit">OK</button>
        </section>
    </form>
</div>
</div>';
}

<div class="parent-middle w3-container">
    <div class="w3-card w3-margin w3-center w3-round-large w3-padding half">
        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <label for="email">
                <p>Email</p>
                <input type="email" name="email" placeholder="example@example.com" required id="email" class="w3-input">
            </label>
            <label for="password" class="w3-margin">
                <p>Password</p>
                <input type="password" name="password" placeholder="Password" required id="password" class="w3-input">
            </label>
            <button type="submit" class="w3-btn w3-round w3-theme-dark w3-margin" name="login" id="login">Log In</button>
        </form>
    </div>
</div>
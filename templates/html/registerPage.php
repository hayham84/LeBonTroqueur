<div class="parent-middle w3-container">
    <div class="w3-card w3-margin w3-center w3-round-large w3-padding half">
        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <label for="email">
                <p>Email</p>
                <input type="email" name="email" placeholder="example@example.com" required id="email" class="w3-input">
            </label>
            <label for="tel">
                <p>Telephone</p>
                <input type="tel" name="tel" placeholder="06 00 00 00 00" required id="tel" class="w3-input">
            </label>
            <label for="name" class="w3-margin">
                <p>Name</p>
                <input type="text" name="name" placeholder="Roger" required id="name"
                       class="w3-input">
            </label>
            <label for="firstname" class="w3-margin">
                <p>First Name</p>
                <input type="text" name="firstname" placeholder="Steve" required id="firstname"
                       class="w3-input">
            </label>
            <label for="password" class="w3-margin">
                <p>Password</p>
                <input type="password" name="password" placeholder="Password" required id="password" class="w3-input">
            </label>
            <label for="password-confirmation" class="w3-margin">
                <p>Password Confirmation</p>
                <input type="password" name="password-confirmation" placeholder="Password confirmation" required
                       id="password-confirmation" class="w3-input">
            </label>
            <button type="submit" class="w3-btn w3-round w3-theme-dark w3-margin" name="register" id="register">Register</button>
        </form>
    </div>
</div>
<div class="parent-middle">
    <div class="w3-card w3-margin w3-center w3-round-large w3-padding half">
        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <?php if (isset($_SESSION["user_id"])): ?>
                <input type="hidden" name="email" value="<?php echo $user->email ?>">
            <?php else: ?>
                <label> Email
                    <input type="email" name="email" class="w3-input" required placeholder="exemple@exemple.com">
                </label>
            <?php endif; ?>
            <label> Object
                <input type="text" id="object" name="object" placeholder="Small title" required class="w3-input">
            </label>
            <label> Message
                <textarea id="message" name="message" placeholder="Message" required class="w3-input"></textarea>
            </label>
            <button type="submit" class="w3-btn w3-round w3-theme-dark w3-margin" name="send" id="send">Send</button>
        </form>
    </div>
</div>

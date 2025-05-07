<div class="parent-middle w3-container">
    <div class="w3-card w3-margin w3-center w3-round-large w3-padding half">
        <form method="POST" onsubmit="return verif()" action="" class="w3-container">
            <label for="name" class="w3-margin">
                <p>Name</p>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user->name); ?>" required id="name"
                       class="w3-input">
            </label>
            <label for="firstname" class="w3-margin">
                <p>First Name</p>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($user->firstname); ?>" required id="firstname"
                       class="w3-input">
            </label>
            <button type="submit" class="w3-btn w3-round w3-theme-dark w3-margin" name="submit" id="submit">Modifier</button>
        </form>
    </div>
</div>

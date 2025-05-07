<div class="parent-middle w3-container">
    <div class="w3-card w3-margin w3-center w3-round-large w3-padding half">
        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <p>
                <input type="checkbox" id="storeColorPreference" name="storeColorPreference" value="1">
                <label for="storeColorPreference">Cookies for user interface settings.</label>
            </p>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
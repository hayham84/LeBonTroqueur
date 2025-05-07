<?php
if (isset($_GET['id'])) {
    $ad = $adDao->selectById($_GET['id']);
}
?>

<div class="parent-middle w3-container">
    <div class="w3-card w3-margin w3-center w3-round-large w3-padding half">
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="ad_id" id="ad_id" value="<?php echo $_GET['id'] ?? 0 ?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <label for="title">
                <p>Title</p>
                <input type="text" name="title" placeholder="Title" required id="title"
                       class="w3-input" <?php echo isset($_GET['id']) ? "value=\"$ad->title\"" : ""; ?>>
            </label>
            <label for="desc">
                <p>description</p>
                <input type="text" name="desc" placeholder="Description" required id="desc"
                       class="w3-input" <?php echo isset($_GET['id']) ? "value=\"$ad->description\"" : ""; ?>>
            </label>
            <label for="location">
                <p>Location</p>
                <input type="text" name="location" placeholder="Paris, France" required id="location" class="w3-input"
                    <?php echo isset($_GET['id']) ? "value=\"$ad->localisation\"" : ""; ?>>
            </label>
            <label for="price">
                <p>Price</p>
                <input type="text" name="price" placeholder="5€" required id="price" class="w3-input"
                    <?php echo isset($_GET['id']) ? "value=\"$ad->price\"" : ""; ?>>
            </label>
            <div>
                <label for="image">
                    Upload Image (Warning: less than 1 Mo)
                    <input type="file" name="image[]" multiple accept=".pdf,.jpg,.jpeg,.png" class="w3-input">
                </label>
            </div>
            <button type="submit" class="w3-btn w3-round w3-theme-dark w3-margin" name="adForm" id="adForm">Change</button>
        </form>
    </div>
</div>
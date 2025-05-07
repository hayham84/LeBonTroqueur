<?php include("cookiesModal.php") ?>
</main>
</div>
<footer class="w3-container w3-gray w3-center w3-margin-top">
    <a href="contact">Contact us!</a>
    <a href="mentions">Legal mentions</a>
    <br>
    <?php if (isset($_COOKIE['bg_color'])): ?>
        <label for="bgColorSelect">Select background color </label><select id="bgColorSelect" name="bgColorSelect"
                                                                           class="w3-round w3-transparent">
            <option value="" selected disabled hidden>Choose here</option>
            <option value="teal">Teal</option>
            <option value="red">Red</option>
        </select>
    <?php endif; ?>
    <p>© <?php echo date("Y") ?> - LeBonTroqueur</p>
</footer>
</body>
</html>
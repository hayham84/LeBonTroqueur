<?php include("cookies.php") ?>
<div class="w3-clear"></div>
<div>
    <footer class="w3-container w3-gray w3-center w3-margin-top">
        <a href="https://pedago.univ-avignon.fr/~uapv2401255/admin/faq">FAQ Admin !</a>
        <br>
        <?php if (isset($_COOKIE['bg_color'])): ?>
            <label for="bgColorSelect">Select background color </label><select id="bgColorSelect" name="bgColorSelect"
                                                                               class="w3-round w3-transparent">
                <option value="" selected disabled hidden>Choose here</option>
                <option value="teal">Teal</option>
                <option value="red">Red</option>
            </select>
        <?php endif; ?>
        <p>© <?php echo date("Y")?> - LeBonTroqueur</p>
    </footer>
</div>
<div class="w3-card w3-container w3-padding w3-quarter">
    <a href="<?php echo "ad?id=".$ad->id ?>" class="clean-ref"><h4><?php echo $ad->title?></h4></a>
    <div class="w3-content w3-display-container">
        <?php
        if(!empty($images)) {
            foreach($images as $index) {?>
                <img class="mySlides" src="<?php echo $index->url; ?>" style="width:100%; <?php echo ($index == 0 ? 'display:block;' : 'display:none;'); ?>" alt="">
            <?php }
        } else { ?>
            <img src="<?php echo 'images/default.png'; ?>" style="width:100%;" alt="">
        <?php } ?>
        <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
</div>

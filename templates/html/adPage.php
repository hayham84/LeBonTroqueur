<div class="w3-container w3-row-padding">
    <div class="w3-twothird">
        <div class="w3-card w3-padding w3-round w3-margin">
            <div>
                <h3><?php echo $ad->title ?></h3>
                <sub>ID = <?php echo $ad->id; ?></sub>
            </div>
            <?php if ($user->id == $_SESSION['user_id']): ?>
            <div>
                <a class="w3-button w3-red w3-margin" href="<?php echo "deleteAd?id=".$ad->id ?>">Delete</a>
                <a class="w3-button w3-theme w3-margin" href="<?php echo "adForm?id=".$ad->id ?>">Update</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="w3-card w3-padding w3-round w3-margin">
            <div>
                <p><?php echo $ad->description; ?></p>
                <p>Localisation : <?php echo $ad->localisation; ?></p>
            </div>
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
    </div>
    <div class="w3-quarter w3-card w3-padding w3-round w3-margin">
        <div class="w3-card w3-padding w3-round w3-theme-dark">
            <h4>Contact</h4>
        </div>
        <div>
            <table class="w3-table">
                <tr>
                    <th>Name</th>
                    <td><?php echo $user->name ?></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><?php echo $user->firstname ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $user->email ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $user->tel ?></td>
                </tr>
            </table>
        </div
    </div>
</div>

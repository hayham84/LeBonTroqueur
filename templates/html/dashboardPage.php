<div class="w3-container parent-middle">
    <div class="w3-card w3-padding w3-margin w3-round w3-half">
        <div class="parent-middle">
            <a class="w3-button w3-theme" href="userForm">Modifier</a>
        </div>
        <table class="w3-table">
            <tr>
                <th>Name :</th>
                <td><?php echo $user->name; ?></td>
            </tr>
            <tr>
                <th>Firstname :</th>
                <td><?php echo $user->firstname; ?></td>
            </tr>
            <tr>
                <th>Email :</th>
                <td><?php echo $user->email; ?></td>
            </tr>
            <tr>
                <th>Phone number :</th>
                <td><?php echo $user->tel; ?></td>
            </tr>
        </table>

    </div>
</div>

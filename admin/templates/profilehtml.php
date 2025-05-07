<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div class="w3-container w3-padding w3-round w3-margin">
    <h2 class="w3-center"><?php echo $title; ?></h2>
    <table class="w3-table-all">
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($user->id); ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($user->email); ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td><?php echo htmlspecialchars($user->tel); ?></td>
            <td><a href="../ModifTel/<?php echo htmlspecialchars($user->id); ?>" class="w3-button w3-teal">Modifier</a></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo htmlspecialchars($user->name); ?></td>
            <td> <a href="../ModifNomPrenom/<?php echo htmlspecialchars($user->id); ?>" class="w3-button w3-teal">Modifier</a></td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td><?php echo htmlspecialchars($user->firstname); ?></td>
            <td> <a href="../ModifNomPrenom/<?php echo htmlspecialchars($user->id); ?>" class="w3-button w3-teal">Modifier</a></td>
        </tr>
        <tr>
            <th>Rôle</th>
            <td><?php echo htmlspecialchars($user->role->role_name); ?></td>
            <td><a href="../ModifRole/<?php echo htmlspecialchars($user->id); ?>" class="w3-button w3-teal">Modifier</a></td>
        </tr>
    </table>
</div>

<div class="w3-padding w3-margin">
    <a href="../SuppressionUsers/<?php echo htmlspecialchars($user->id); ?>" class="w3-button w3-red" >Supprimer</a>
    <a href='../tableauUsers' class='w3-button w3-teal'>Retour</a>
</div>
</body>
</html>
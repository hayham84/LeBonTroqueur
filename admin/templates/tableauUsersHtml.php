<html>
<head>
    <title>Gestion Utilisateurs</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<div class="w3-container">
    <h2>Gestion des Utilisateurs</h2>
    <p>Ce tableau affiche l'ID, le nom et le prénom de chaque utilisateur avec un lien vers la page de détails.</p>

    <table class="w3-table-all w3-centered">
        <thead>
        <tr class="w3-teal">
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Détails</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user->id); ?></td>
                <td><?php echo htmlspecialchars($user->name); ?></td>
                <td><?php echo htmlspecialchars($user->firstname); ?></td>
                <td>
                    <a href="accesProfile/<?php echo htmlspecialchars($user->id); ?>" class="w3-button w3-teal">
                        Voir détails
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>


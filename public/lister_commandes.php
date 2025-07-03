<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Service\CommandeService;

$service = new CommandeService();
$commandes = $service->listerCommandes();
?>

<h1>Liste des Commandes</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Client</th>
        <th>Vendeur</th>
    </tr>
    <?php foreach ($commandes as $commande): ?>
        <tr>
            <td><?= htmlspecialchars($commande->getId()) ?></td>
            <td><?= htmlspecialchars($commande->getDate()) ?></td>
            <td><?= htmlspecialchars($commande->getClientId()) ?></td>
            <td><?= htmlspecialchars($commande->getVendeurId()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
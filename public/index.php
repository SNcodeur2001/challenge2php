<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Service\CommandeService;
use App\Repository\ProduitRepository;
use App\Repository\PersonneRepository;
use App\Repository\FactureRepository;

// Services et repositories
$commandeService = new CommandeService();
$produitRepo = new ProduitRepository();
$personneRepo = new PersonneRepository();
$factureRepo = new FactureRepository();

// Récupération des données
$commandes = $commandeService->listerCommandes();
$produits = $produitRepo->findAll();
$clients = array_filter($personneRepo->selectAll(), fn($p) => $p instanceof \App\Entity\Client);

// Voir facture d'une commande
$facture = null;
if (isset($_GET['facture']) && is_numeric($_GET['facture'])) {
    $facture = $factureRepo->selectFactureCommande((int)$_GET['facture']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Gestion Auchan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tab-active {
            @apply border-b-4 border-blue-600 text-blue-700 bg-blue-50;
        }
        .tab-inactive {
            @apply text-gray-500 hover:text-blue-600 hover:bg-blue-50;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-100 min-h-screen">
    <!-- Header -->
    <header class="sticky top-0 z-30 bg-white/80 backdrop-blur shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold text-blue-700 tracking-tight">Gestion Auchan</h1>
            <nav>
                <ul class="flex gap-4 text-lg font-semibold">
                    <li><button class="tab-btn tab-active px-4 py-2 rounded transition" data-tab="commandes">Commandes</button></li>
                    <li><button class="tab-btn tab-inactive px-4 py-2 rounded transition" data-tab="produits">Produits</button></li>
                    <li><button class="tab-btn tab-inactive px-4 py-2 rounded transition" data-tab="clients">Clients</button></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4">
        <!-- Commandes -->
        <section id="tab-commandes" class="tab-content">
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 text-blue-600 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
                    Commandes
                </h2>
                <div class="overflow-x-auto rounded-lg shadow bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Client</th>
                                <th class="px-4 py-2">Vendeur</th>
                                <th class="px-4 py-2">Voir Facture</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandes as $commande): ?>
                                <tr class="border-b hover:bg-blue-50 transition">
                                    <td class="px-4 py-2"><?= htmlspecialchars($commande->getId()) ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($commande->getDate()) ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($commande->getClient()?->getNom() ?? '') ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($commande->getVendeur()?->getNom() ?? '') ?></td>
                                    <td class="px-4 py-2">
                                        <a href="?facture=<?= $commande->getId() ?>" class="inline-block px-3 py-1 rounded bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition">Voir facture</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Voir la facture -->
            <?php if ($facture): ?>
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-red-600">Facture de la commande #<?= htmlspecialchars($facture->getCommande()->getId()) ?></h2>
                    <div class="bg-white rounded shadow p-6 max-w-lg mx-auto">
                        <p><span class="font-semibold">Date :</span> <?= htmlspecialchars($facture->getDate()) ?></p>
                        <p><span class="font-semibold">Montant :</span> <?= htmlspecialchars($facture->getMontant()) ?> €</p>
                        <p><span class="font-semibold">Statut :</span> <?= htmlspecialchars($facture->getStatut()->value) ?></p>
                        <a href="index.php" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Retour aux commandes</a>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <!-- Produits -->
        <section id="tab-produits" class="tab-content hidden">
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 text-green-600 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    Produits
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($produits as $produit): ?>
                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-lg font-bold text-green-700">#<?= htmlspecialchars($produit->getId()) ?></span>
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold"><?= htmlspecialchars($produit->getQteStock()) ?> en stock</span>
                            </div>
                            <div class="text-2xl font-extrabold text-green-600 mb-2"><?= htmlspecialchars($produit->getPrix()) ?> €</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Clients -->
        <section id="tab-clients" class="tab-content hidden">
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 text-purple-600 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87M23 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM1 7a4 4 0 1 0 8 0 4 4 0 0 0-8 0z"/></svg>
                    Clients
                </h2>
                <div class="overflow-x-auto rounded-lg shadow bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-purple-100">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nom</th>
                                <th class="px-4 py-2">Téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clients as $client): ?>
                                <tr class="border-b hover:bg-purple-50 transition">
                                    <td class="px-4 py-2"><?= htmlspecialchars($client->getId()) ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($client->getNom()) ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($client->getTelephone()) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Onglets dynamiques
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('tab-active'));
                tabBtns.forEach(b => b.classList.add('tab-inactive'));
                btn.classList.add('tab-active');
                btn.classList.remove('tab-inactive');
                tabContents.forEach(tc => tc.classList.add('hidden'));
                document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
            });
        });
        // Affiche la bonne tab si facture affichée
        <?php if ($facture): ?>
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('tab-active', 'tab-inactive'));
        document.querySelector('.tab-btn[data-tab="commandes"]').classList.add('tab-active');
        document.getElementById('tab-commandes').classList.remove('hidden');
        <?php endif; ?>
    </script>
</body>
</html>
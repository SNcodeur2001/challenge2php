<div class="max-w-6xl mx-auto mt-6 p-6 bg-[#151f11] rounded-lg shadow-lg">
  <!-- Header -->


  <!-- Titre -->
  <h1 class="text-3xl font-bold mb-8">Liste des commandes</h1>

  <!-- Filtres -->
  <div class="flex space-x-4 mb-8">
    <button
      class="bg-[#1a2b13] text-white px-6 py-2 rounded-lg flex items-center space-x-2 hover:bg-lime-700 transition">
      <span>Filtrer par status</span>
      <svg
        class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">
        <path d="M19 9l-7 7-7-7" />
      </svg>
    </button>
    <button
      class="bg-[#1a2b13] text-white px-6 py-2 rounded-lg flex items-center space-x-2 hover:bg-lime-700 transition">
      <span>Filtrer par client</span>
      <svg
        class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">
        <path d="M19 9l-7 7-7-7" />
      </svg>
    </button>
    <button
      class="bg-[#1a2b13] text-white px-6 py-2 rounded-lg flex items-center space-x-2 hover:bg-lime-700 transition">
      <span>Filtrer par Etat</span>
      <svg
        class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">
        <path d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <a href="/commande" class="
            bg-lime-400 text-[#101d0b] px-6 py-2 rounded-lg font-semibold hover:bg-lime-500 transition">Passer commande</a>
      </div>

      <!-- Tableau -->
      <div class=" bg-[#1a2b13] rounded-xl overflow-hidden">
      <table class="min-w-full text-left">
        <thead>
          <tr class="text-lime-400">
            <th class="px-6 py-3">Numero Commande</th>
            <th class="px-6 py-3">Client</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Montant</th>

          </tr>
        </thead>
        <tbody>

 <?php foreach ($commandes as $commande): ?>
  <tr class="border-t border-[#263a1d]">
    <!-- Colonne Commande -->
    <td class="px-6 py-4">
      #COM_<?= htmlspecialchars($commande->getId()) ?>
      <br>
      <span class="text-xs text-gray-400"><?= htmlspecialchars($commande->getDate()) ?></span>
    </td>
    
    <!-- Colonne Client -->
    <td class="px-6 py-4">
      <?= htmlspecialchars($commande->getClient() ? $commande->getClient()->getNom() : 'Anonyme') ?>
      <br>
      <span class="text-xs text-gray-400">
        <?= htmlspecialchars($commande->getClient() ? $commande->getClient()->getTelephone() : '') ?>
      </span>
    </td>
    
    <!-- Colonne Vendeur -->
    <!-- <td class="px-6 py-4">
      <?php if ($commande->getVendeur()): ?>
        <?= htmlspecialchars($commande->getVendeur()->getNom() ?? 'Vendeur') ?>
        <br>
        <span class="text-xs text-gray-400">
          <?php if (method_exists($commande->getVendeur(), 'getPrenom')): ?>
            <?= htmlspecialchars($commande->getVendeur()->getPrenom()) ?>
          <?php elseif (method_exists($commande->getVendeur(), 'getEmail')): ?>
            <?= htmlspecialchars($commande->getVendeur()->getEmail()) ?>
          <?php else: ?>
            ID: <?= htmlspecialchars($commande->getVendeur()->getId()) ?>
          <?php endif; ?>
        </span>
      <?php else: ?>
        Non assigné
        <br>
        <span class="text-xs text-gray-400">-</span>
      <?php endif; ?>
    </td> -->
    
    <!-- Colonne Statut -->
    <td class="px-6 py-4">
      <span class="bg-[#263a1d] text-lime-400 px-4 py-1 rounded-full text-sm">
        <?= htmlspecialchars($commande->getStatut() ?? 'En cours') ?>
      </span>
    </td>
    
    <!-- Colonne Montant Total -->
    <td class="px-6 py-4">
      <span class="text-lime-400 font-semibold text-lg">
        <?php if (method_exists($commande, 'getMontantTotal')): ?>
          <?= number_format($commande->getMontantTotal(), 0, ',', ' ') ?> F
        <?php else: ?>
          <?php 
          $total = 0;
          foreach ($commande->getProduitCommandes() as $pc) {
            $total += $pc->getMontant();
          }
          ?>
          <?= number_format($total, 0, ',', ' ') ?> F
        <?php endif; ?>
      </span>
    </td>
    
    <!-- Colonne Produits -->
    <!-- <td class="px-6 py-4">
      <ul class="text-xs text-gray-300 space-y-1">
        <?php foreach ($commande->getProduitCommandes() as $pc): ?>
          <li class="flex justify-between">
            <span>
              <?php if (method_exists($pc->getProduit(), 'getNom')): ?>
                <?= htmlspecialchars($pc->getProduit()->getNom()) ?>
              <?php else: ?>
                Produit #<?= htmlspecialchars($pc->getProduit()->getId()) ?>
              <?php endif; ?>
            </span>
            <span class="text-gray-400">
              x<?= htmlspecialchars($pc->getQuantiteCommande()) ?> 
              (<?= number_format($pc->getMontant(), 0, ',', ' ') ?> F)
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    </td> -->
    
    <!-- Colonne Actions -->
    <td class="px-6 py-4">
      <div class="flex space-x-2">
        <a
          href="/facture?id=<?= htmlspecialchars($commande->getId()) ?>"
          class="bg-lime-400 text-[#101d0b] px-4 py-1 rounded-full font-semibold hover:bg-lime-500 transition text-sm">
          Facture
        </a>
        <a
          href="/commande/edit?id=<?= htmlspecialchars($commande->getId()) ?>"
          class="bg-[#263a1d] text-lime-400 px-4 py-1 rounded-full font-semibold hover:bg-[#1a2b13] transition text-sm border border-lime-400">
          Modifier
        </a>
      </div>
    </td>
  </tr>
<?php endforeach; ?>


          <!-- <tr class="border-t border-[#263a1d]">
              <td class="px-6 py-4">#COM_002</td>
              <td class="px-6 py-4">ANONYME</td>
              <td class="px-6 py-4">
                <span class="bg-[#263a1d] text-lime-400 px-4 py-1 rounded-full"
                  >impayé</span
                >
              </td>
              <td class="px-6 py-4">
                <button
                  class="bg-lime-400 text-[#101d0b] px-6 py-1 rounded-full font-semibold hover:bg-lime-500 transition"
                >
                  voir
                </button>
              </td>
            </tr>
            <tr class="border-t border-[#263a1d]">
              <td class="px-6 py-4">#COM_003</td>
              <td class="px-6 py-4">Serigne Pathé</td>
              <td class="px-6 py-4">
                <span class="bg-[#263a1d] text-lime-400 px-4 py-1 rounded-full"
                  >imayé</span
                >
              </td>
              <td class="px-6 py-4">
                <button
                  class="bg-lime-400 text-[#101d0b] px-6 py-1 rounded-full font-semibold hover:bg-lime-500 transition"
                >
                  voir
                </button>
              </td>
            </tr> -->


        </tbody>
      </table>
  </div>

  <!-- Pagination -->
  <div class="flex justify-center items-center mt-8 space-x-3">
    <button
      class="text-lime-400 hover:bg-[#263a1d] rounded-full w-8 h-8 flex items-center justify-center">
      &lt;
    </button>
    <button
      class="bg-lime-400 text-[#101d0b] rounded-full w-8 h-8 font-bold">
      1
    </button>
    <button class="text-lime-400 hover:bg-[#263a1d] rounded-full w-8 h-8">
      2
    </button>
    <button class="text-lime-400 hover:bg-[#263a1d] rounded-full w-8 h-8">
      3
    </button>
    <button
      class="text-lime-400 hover:bg-[#263a1d] rounded-full w-8 h-8 flex items-center justify-center">
      &gt;
    </button>
  </div>
</div>
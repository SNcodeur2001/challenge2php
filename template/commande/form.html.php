<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nouveau Commande</title>
</head>
<body class="bg-[#181f13] min-h-screen flex flex-col">
    <!-- Navbar -->
   

    <main class="flex-1 flex justify-center items-center">
        <div class="w-full max-w-3xl mx-auto mt-8 bg-[#232d1a] rounded-lg p-8 shadow-lg">
            <h2 class="text-3xl font-bold text-white mb-8">Nouveau Commande</h2>
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-300 mb-2">Client</label>
                    <select class="w-full bg-[#181f13] border-none rounded-lg px-4 py-3 text-gray-200 focus:outline-none">
                        <option>Selectionner client</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-300 mb-2">Paiement</label>
                    <input type="text" placeholder="Entrer le montant" class="w-full bg-[#181f13] border-none rounded-lg px-4 py-3 text-gray-200 focus:outline-none"/>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-white mb-4">Ajouter Produit</h3>
                <div class="flex space-x-4">
                    <select class="bg-[#181f13] border-none rounded-lg px-4 py-2 text-gray-200 focus:outline-none">
                        <option>Selectionner un produit.</option>
                    </select>
                    <input type="text" placeholder="Saisir le montant" class="bg-[#181f13] border-none rounded-lg px-4 py-2 text-gray-200 focus:outline-none"/>
                    <button class="bg-lime-400 hover:bg-lime-500 text-white font-semibold px-6 py-2 rounded-lg transition">Ajouter</button>
                </div>
            </div>
            <div class="bg-[#181f13] rounded-lg overflow-hidden mb-6">
                <table class="w-full text-left text-gray-200">
                    <thead>
                        <tr class="border-b border-[#3a4630]">
                            <th class="py-3 px-4 font-semibold">Produits</th>
                            <th class="py-3 px-4 font-semibold">Quantité</th>
                            <th class="py-3 px-4 font-semibold">Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-[#3a4630]">
                            <td class="py-3 px-4">Sac de riz</td>
                            <td class="py-3 px-4">2</td>
                            <td class="py-3 px-4">40.000 <span class="font-bold">fcfa</span></td>
                        </tr>
                        <tr class="border-b border-[#3a4630]">
                            <td class="py-3 px-4">Sucre</td>
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4">30.000<span class="font-bold">fcfa</span></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4">Lait</td>
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4">2.200 <span class="font-bold">fcfa</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex justify-center items-center space-x-2 mb-8">
                <button class="w-8 h-8 flex items-center justify-center rounded bg-[#232d1a] text-gray-400 hover:bg-[#181f13]">&lt;</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-full bg-lime-400 text-white font-bold">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded bg-[#232d1a] text-gray-200 hover:bg-[#181f13]">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded bg-[#232d1a] text-gray-200 hover:bg-[#181f13]">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded bg-[#232d1a] text-gray-400 hover:bg-[#181f13]">&gt;</button>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xl font-bold text-white">Total:</span>
                    <span class="text-lg text-gray-200 ml-2">72.200 <span class="font-bold">fcfa</span></span>
                </div>
                <a  href="/facture" class="bg-lime-400 hover:bg-lime-500 text-white font-semibold px-8 py-2 rounded-full transition">Valider commande</a>
            </div>
        </div>
    </main>
</body>
</html>
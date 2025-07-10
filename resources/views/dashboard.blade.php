<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-gray-800">Tableau de bord</h2>
            <span class="text-sm text-gray-500">Mis à jour : {{ now()->format('d/m/Y H:i') }}</span>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Cartes Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Carte total produits -->
            <div class="rounded-xl shadow bg-gradient-to-br from-blue-100 to-blue-50 p-5 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold text-blue-600">Produits en stock</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProduits }}</p>
                        <span class="text-xs text-blue-500">Total inventaire</span>
                    </div>
                    <div class="text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Cartes par catégorie -->
            @foreach ($categories as $categorie)
            <div class="rounded-xl shadow bg-gradient-to-br from-green-100 to-green-50 p-5 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold text-green-600">{{ $categorie->nom }}</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $categorie->produits_count }}</p>
                        <span class="text-xs text-green-500">Produits</span>
                    </div>
                    <div class="text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Section Graphiques -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Graphique en barres -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Produits par catégorie</h3>
                </div>
                <div class="relative h-80">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <!-- Graphique circulaire -->
            <div class="bg-white rounded-xl shadow p-5">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Répartition par catégorie</h3>
                </div>
                <div class="relative h-80">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const colors = [
            '#3b82f6', '#10b981', '#f59e0b',
            '#ef4444', '#8b5cf6', '#ec4899'
        ];

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categories->pluck('nom')) !!},
                datasets: [{
                    label: 'Produits',
                    data: {!! json_encode($categories->pluck('produits_count')) !!},
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Quantité' }
                    },
                    x: {
                        title: { display: true, text: 'Catégories' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($categories->pluck('nom')) !!},
                datasets: [{
                    data: {!! json_encode($categories->pluck('produits_count')) !!},
                    backgroundColor: colors.slice(0, {{ $categories->count() }})
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</x-app-layout>

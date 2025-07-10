<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <h2 class="dashboard-title">Tableau de bord</h2>
            <span class="update-time">Mis à jour : {{ now()->format('d/m/Y H:i') }}</span>
        </div>
    </x-slot>

    <div class="dashboard-container">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <!-- Total products card -->
            <div class="stat-card blue-card">
                <div class="stat-content">
                    <div>
                        <h3 class="stat-title">Produits en stock</h3>
                        <p class="stat-value">{{ $totalProduits }}</p>
                        <span class="stat-label">Total inventaire</span>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Category cards -->
            @foreach ($categories as $categorie)
            <div class="stat-card green-card">
                <div class="stat-content">
                    <div>
                        <h3 class="stat-title">{{ $categorie->nom }}</h3>
                        <p class="stat-value">{{ $categorie->produits_count }}</p>
                        <span class="stat-label">Produits</span>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <!-- Bar chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Produits par catégorie</h3>
                </div>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <!-- Pie chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Répartition par catégorie</h3>
                </div>
                <div class="chart-container">
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

    <style>
        /* Base styles */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        
        .dashboard-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .update-time {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .dashboard-container {
            padding: 2rem 0;
            max-width: 80rem;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        /* Stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        /* Stat cards */
        .stat-card {
            border-radius: 0.75rem;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .blue-card {
            background: linear-gradient(to bottom right, #ebf4ff, #e1effe);
        }
        
        .green-card {
            background: linear-gradient(to bottom right, #ecfdf5, #d1fae5);
        }
        
        .stat-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stat-title {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .blue-card .stat-title {
            color: #2563eb;
        }
        
        .green-card .stat-title {
            color: #059669;
        }
        
        .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0.25rem 0;
        }
        
        .stat-label {
            font-size: 0.75rem;
        }
        
        .blue-card .stat-label {
            color: #3b82f6;
        }
        
        .green-card .stat-label {
            color: #10b981;
        }
        
        .stat-icon svg {
            height: 2rem;
            width: 2rem;
            opacity: 0.5;
        }
        
        .blue-card .stat-icon {
            color: #60a5fa;
        }
        
        .green-card .stat-icon {
            color: #34d399;
        }
        
        /* Charts grid */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }
        
        @media (min-width: 1024px) {
            .charts-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .chart-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .chart-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .chart-container {
            position: relative;
            height: 20rem;
        }
    </style>
</x-app-layout>
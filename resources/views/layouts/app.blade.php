<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Boutique</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        body {
            background-color: #f3f4f6;
            color: #1f2937;
        }
        
        .flex {
            display: flex;
        }
        
        .min-h-screen {
            min-height: 100vh;
        }
        
        /* Sidebar toggle button (mobile) */
        .sidebar-toggle {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem;
            margin-top: 1rem;
            margin-left: 1rem;
            font-size: 0.875rem;
            color: #6b7280;
            border-radius: 0.375rem;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .sidebar-toggle:hover {
            background-color: #e5e7eb;
        }
        
        .sidebar-toggle svg {
            width: 1.5rem;
            height: 1.5rem;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 40;
            width: 16rem;
            height: 100vh;
            background-color: white;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .sidebar.visible {
            transform: translateX(0);
        }
        
        .sidebar-content {
            height: 100%;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
        }
        
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            font-size: 1rem;
            font-weight: 500;
        }
        
        .sidebar-nav a {
            color: inherit;
            text-decoration: none;
            display: block;
            padding: 0.25rem 0;
        }
        
        .sidebar-nav a:hover {
            color: #3b82f6;
        }
        
        .ml-4 {
            margin-left: 1rem;
        }
        
        .ml-6 {
            margin-left: 1.5rem;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
        
        /* Main content */
        .main-content {
            flex: 1;
            margin-left: 0;
            padding: 1.5rem;
            background-color: #f3f4f6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 72rem;
            margin: 0 auto;
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        /* Responsive */
        @media (min-width: 640px) {
            .sidebar {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 16rem;
            }
            
            .sidebar-toggle {
                display: none;
            }
        }
        
        /* Logout button */
        .logout-btn {
            background: none;
            border: none;
            color: inherit;
            font: inherit;
            cursor: pointer;
            padding: 0.25rem 0;
            text-align: left;
        }
        
        .logout-btn:hover {
            color: #3b82f6;
        }
    </style>
</head>
<body>

<div class="flex min-h-screen">
    <!-- Bouton mobile pour ouvrir la sidebar -->
    <button id="sidebarToggle" class="sidebar-toggle" aria-label="Toggle sidebar">
        <svg fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zM2 15.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                  clip-rule="evenodd"/>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar" aria-label="Sidebar">
        <div class="sidebar-content">
            <div class="sidebar-title">📦 Ma Boutique</div>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
            
                <!-- Produits -->
                <a href="{{ route('produits.index') }}">📋 Produits</a>
                <a href="{{ route('produits.create') }}" class="ml-4">➕ Ajouter Produit</a>
            
                <!-- Catégories -->
                <a href="{{ route('categories.index') }}" class="ml-4">📂 Catégories</a>
                <a href="{{ route('categories.create') }}" class="ml-6 text-sm">➕ Nouvelle catégorie</a>
            
                <!-- Déconnexion -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Se déconnecter</button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Contenu principal -->
    <main class="main-content">
        <div class="container">
            {{ $slot }}
        </div>
    </main>
</div>

<script>
    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('visible');
    });
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ma Boutique</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Assurez-vous que Tailwind est bien compilé --}}
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    {{-- Bouton mobile pour ouvrir la sidebar --}}
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
            aria-controls="logo-sidebar" type="button"
            class="inline-flex items-center p-2 mt-4 ms-4 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zM2 15.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                  clip-rule="evenodd"/>
        </svg>
    </button>

    {{-- Sidebar --}}
    <aside  id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-4 py-6 space-y-6">
            <div class="text-2xl font-bold text-blue-600">📦 Ma Boutique</div>

            <nav class="flex flex-col gap-4 text-base font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600">🏠 Dashboard</a>
            
                {{-- Produits --}}
                <a href="{{ route('produits.index') }}" class="hover:text-blue-600">📋 Produits</a>
                <a href="{{ route('produits.create') }}" class="hover:text-blue-600 ml-4">➕ Ajouter Produit</a>
            
                {{-- Catégories --}}
                <a href="{{ route('categories.index') }}" class="hover:text-blue-600 ml-4">📂 Catégories</a>
                <a href="{{ route('categories.create') }}" class="hover:text-blue-600 ml-6 text-sm">➕ Nouvelle catégorie</a>
            
                {{-- Déconnexion --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
                
            </nav>
            
        </div>
    </aside>

    {{-- Contenu principal --}}
    <main class="flex-1 ml-0 sm:ml-64 p-6 sm:p-10 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
            {{ $slot }}
        </div>
    </main>

</div>

</body>
</html>

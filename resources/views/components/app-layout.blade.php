<!-- resources/views/components/app-layout.blade.php -->
<div class="flex min-h-screen bg-gray-100">
    
    {{-- Sidebar --}}
    <div class="w-64 bg-white shadow-lg p-4">
        <h2 class="text-xl font-bold mb-4">Menu</h2>
        <ul class="space-y-2">
            <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a></li>
            <li><a href="{{ route('produits.index') }}" class="text-blue-600 hover:underline">Produits</a></li>
            <li><a href="{{ route('produits.create') }}" class="text-blue-600 hover:underline">Ajouter Produit</a></li>
            {{-- Ajoute d'autres liens ici --}}
        </ul>
    </div>

    {{-- Contenu principal --}}
    <div class="flex-1 p-6">
        {{ $slot }}
    </div>

</div>
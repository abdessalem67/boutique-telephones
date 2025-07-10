<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Liste des produits</h1>

        {{-- Messages de session --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 border border-red-300">
                {{ session('error') }}
            </div>
        @endif

        {{-- Bouton d'ajout --}}
        <a href="{{ route('produits.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded mb-4 inline-block transition">
            + Ajouter un produit
        </a>

        {{-- Barre de recherche --}}
        <form method="GET" action="{{ route('produits.index') }}" class="mb-6 flex flex-wrap items-center gap-3">
            <input type="text" name="search" placeholder="Rechercher un produit..."
                   value="{{ request('search') }}"
                   class="border border-gray-300 rounded px-4 py-2 w-full sm:max-w-xs shadow-sm focus:ring focus:ring-blue-200">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Rechercher
            </button>
        </form>
        <div class="mb-4 flex gap-2 overflow-x-auto">
            <a href="{{ route('produits.index') }}" class="px-4 py-2 rounded border text-sm {{ request('categorie') ? 'bg-white text-gray-700' : 'bg-blue-600 text-white' }}">
                Toutes
            </a>
            @foreach($categories as $categorie)
                <a href="{{ route('produits.index', ['categorie' => $categorie->id]) }}"
                   class="px-4 py-2 rounded border text-sm {{ request('categorie') == $categorie->id ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
                    {{ $categorie->nom }}
                </a>
            @endforeach
        </div>
        
        {{-- Table des produits --}}
        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Image</th>
                        <th class="text-left px-4 py-3">Nom</th>
                        <th class="text-left px-4 py-3">Prix</th>
                        <th class="text-left px-4 py-3">Stock</th>
                        <th class="text-left px-4 py-3">Catégorie</th>
                        <th class="text-left px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $produit)
                        <tr class="border-t hover:bg-gray-70">
                            <td class="px-4 py-2">
                                @if($produit->image)
                                    <img src="{{ asset('storage/' . $produit->image) }}" class="w-16 h-16 object-cover rounded shadow">
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-800">{{ $produit->nom }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ number_format($produit->prix, 2) }} DA</td>
                            <td class="px-4 py-2 text-gray-700">{{ $produit->stock }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $produit->categorie->nom }}</td>
                            <td class="px-7 py-2 space-y-1">
                                
                                <a href="{{ route('produits.show', $produit) }}" 
                                class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                Voir
                             </a>
                                                           <a href="{{ route('produits.edit', $produit) }}"
                                   class="inline-block bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-500 transition">
                                    Modifier
                                </a>

                                {{-- Supprimer --}}
                                <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                                        Supprimer
                                    </button>
                                </form>

                                {{-- Décrémenter --}}
                                <form action="{{ route('produits.decrement', $produit) }}" method="POST" class="inline-block mt-1">
                                    @csrf
                                    <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded transition">
                                        -1 Stock
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 italic">
                                Aucun produit trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

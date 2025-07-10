<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
            {{-- Titre du produit --}}
            <h2 class="text-3xl font-semibold text-gray-800">{{ $produit->nom }}</h2>

            {{-- Image du produit --}}
            @if($produit->image)
    <div class="flex justify-center">
        <img src="{{ asset('storage/' . $produit->image) }}" 
             alt="{{ $produit->nom }}" 
             class="w-28 h-28 object-cover rounded-lg border border-gray-200 shadow">
    </div>
@endif

        
            


            {{-- Détails du produit --}}
            <div class="text-gray-700 space-y-2">
                <p>
                    <span class="font-medium text-gray-900">Prix :</span>
                    {{ number_format($produit->prix, 2) }} DA
                </p>
                <p>
                    <span class="font-medium text-gray-900">Stock :</span>
                    {{ $produit->stock }}
                </p>
                <p>
                    <span class="font-medium text-gray-900">Catégorie :</span>
                    {{ $produit->categorie->nom }}
                </p>
            </div>

            {{-- Bouton retour --}}
            <div class="pt-4">
                <a href="{{ route('produits.index') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-md transition">
                    ← Retour à la liste
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

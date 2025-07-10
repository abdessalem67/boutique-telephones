<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Modifier le produit</h1>

        <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">Nom</label>
                <input type="text" name="nom" value="{{ $produit->nom }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2">{{ $produit->description }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Prix (DA)</label>
                <input type="number" step="0.01" name="prix" value="{{ $produit->prix }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Stock</label>
                <input type="number" name="stock" value="{{ $produit->stock }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Catégorie</label>
                <select name="categorie_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Image actuelle</label>
                @if($produit->image)
                    <img src="{{ asset('storage/' . $produit->image) }}" class="w-24 h-24 object-cover rounded mb-2">
                @else
                    <p class="text-gray-400">Aucune image</p>
                @endif
                <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Modifier</button>
        </form>
    </div>
</x-app-layout>

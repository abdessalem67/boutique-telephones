<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Ajouter un produit</h1>

        <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Nom</label>
                <input type="text" name="nom" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Prix (DA)</label>
                <input type="number" step="0.01" name="prix" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Stock</label>
                <input type="number" name="stock" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Catégorie</label>
                <select name="categorie_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Image</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Enregistrer</button>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Modifier la catégorie</h1>

        <form action="{{ route('categories.update', $categorie) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">Nom</label>
                <input type="text" name="nom" value="{{ $categorie->nom }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2">{{ $categorie->description }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Modifier
            </button>
        </form>
    </div>
</x-app-layout>

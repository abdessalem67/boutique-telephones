<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Ajouter une catégorie</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Nom</label>
                <input type="text" name="nom" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Enregistrer
            </button>
        </form>
    </div>
</x-app-layout>

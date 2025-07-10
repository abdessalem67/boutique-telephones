<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6">Liste des catégories</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Ajouter une catégorie</a>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2">Nom</th>
                        <th class="text-left px-4 py-2">Description</th>
                        <th class="text-left px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $categorie)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $categorie->nom }}</td>
                            <td class="px-4 py-2">{{ $categorie->description }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('categories.edit', $categorie) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Modifier</a>

                                <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

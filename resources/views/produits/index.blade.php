<x-app-layout>
    <div class="products-container">
        <h1 class="products-title">Liste des produits</h1>

        {{-- Session messages --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Add product button --}}
        <a href="{{ route('produits.create') }}" class="add-product-btn">
            + Ajouter un produit
        </a>

        {{-- Search form --}}
        <form method="GET" action="{{ route('produits.index') }}" class="search-form">
            <input type="text" name="search" placeholder="Rechercher un produit..."
                   value="{{ request('search') }}"
                   class="search-input">
            <button type="submit" class="search-btn">
                Rechercher
            </button>
        </form>

        {{-- Category filter --}}
        <div class="category-filter">
            <a href="{{ route('produits.index') }}" class="category-tag {{ !request('categorie') ? 'active' : '' }}">
                Toutes
            </a>
            @foreach($categories as $categorie)
                <a href="{{ route('produits.index', ['categorie' => $categorie->id]) }}"
                   class="category-tag {{ request('categorie') == $categorie->id ? 'active' : '' }}">
                    {{ $categorie->nom }}
                </a>
            @endforeach
        </div>
        
        {{-- Products table --}}
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $produit)
                        <tr class="product-row">
                            <td>
                                @if($produit->image)
                                    <img src="{{ asset('storage/' . $produit->image) }}" class="product-image">
                                @else
                                    <span class="no-image">Aucune</span>
                                @endif
                            </td>
                            <td class="product-name">{{ $produit->nom }}</td>
                            <td class="product-price">{{ number_format($produit->prix, 2) }} DA</td>
                            <td class="product-stock">{{ $produit->stock }}</td>
                            <td class="product-category">{{ $produit->categorie->nom }}</td>
                            <td class="product-actions">
                                <div class="action-buttons">
                                    <a href="{{ route('produits.show', $produit) }}" class="action-btn view-btn">
                                        Voir
                                    </a>
                                    <a href="{{ route('produits.edit', $produit) }}" class="action-btn edit-btn">
                                        Modifier
                                    </a>
                                    <form action="{{ route('produits.destroy', $produit) }}" method="POST" 
                                          onsubmit="return confirm('Supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn delete-btn">
                                            Supprimer
                                        </button>
                                    </form>
                                    <form action="{{ route('produits.decrement', $produit) }}" method="POST">
                                        @csrf
                                        <button class="action-btn decrement-btn">
                                            -1 Stock
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="no-products">
                                Aucun produit trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<style>
    /* Base styles */
    .products-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 1.5rem;
    }
    
    /* Title */
    .products-title {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
    }
    
    /* Alerts */
    .alert-success {
        background-color: #f0fdf4;
        color: #166534;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: 1px solid #bbf7d0;
        margin-bottom: 1rem;
    }
    
    .alert-error {
        background-color: #fef2f2;
        color: #991b1b;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: 1px solid #fecaca;
        margin-bottom: 1rem;
    }
    
    /* Add product button */
    .add-product-btn {
        display: inline-block;
        background-color: #2563eb;
        color: white;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1.5rem;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    
    .add-product-btn:hover {
        background-color: #1d4ed8;
    }
    
    /* Search form */
    .search-form {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .search-input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        width: 100%;
        max-width: 20rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    
    .search-input:focus {
        outline: none;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.5);
    }
    
    .search-btn {
        background-color: #2563eb;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .search-btn:hover {
        background-color: #1d4ed8;
    }
    
    /* Category filter */
    .category-filter {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }
    
    .category-tag {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        font-size: 0.875rem;
        text-decoration: none;
        color: #374151;
        background-color: white;
        white-space: nowrap;
    }
    
    .category-tag.active {
        background-color: #2563eb;
        color: white;
        border-color: #2563eb;
    }
    
    /* Table */
    .table-container {
        overflow-x: auto;
    }
    
    .products-table {
        width: 100%;
        background-color: white;
        border-radius: 0.375rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        border-collapse: collapse;
    }
    
    .products-table th {
        text-align: left;
        padding: 0.75rem 1rem;
        background-color: #f3f4f6;
        color: #374151;
        text-transform: uppercase;
        font-size: 0.75rem;
    }
    
    .products-table td {
        padding: 0.5rem 1rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .product-row:hover {
        background-color: #f9fafb;
    }
    
    /* Product image */
    .product-image {
        width: 4rem;
        height: 4rem;
        object-fit: cover;
        border-radius: 0.375rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .no-image {
        color: #9ca3af;
        font-style: italic;
    }
    
    /* Product details */
    .product-name {
        font-weight: 500;
        color: #1f2937;
    }
    
    .product-price, .product-stock, .product-category {
        color: #4b5563;
    }
    
    /* Action buttons */
    .product-actions {
        min-width: 12rem;
    }
    
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .action-btn {
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    
    .view-btn {
        background-color: #2563eb;
        color: white;
    }
    
    .view-btn:hover {
        background-color: #1d4ed8;
    }
    
    .edit-btn {
        background-color: #f59e0b;
        color: #1f2937;
    }
    
    .edit-btn:hover {
        background-color: #d97706;
    }
    
    .delete-btn {
        background-color: #ef4444;
        color: white;
    }
    
    .delete-btn:hover {
        background-color: #dc2626;
    }
    
    .decrement-btn {
        background-color: #6b7280;
        color: white;
    }
    
    .decrement-btn:hover {
        background-color: #4b5563;
    }
    
    /* No products message */
    .no-products {
        text-align: center;
        padding: 1rem;
        color: #6b7280;
        font-style: italic;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .products-container {
            padding: 1rem;
        }
        
        .products-title {
            font-size: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .action-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
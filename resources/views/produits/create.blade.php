<x-app-layout>
    <div class="form-container">
        <h1 class="form-title">Ajouter un produit</h1>

        <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <div class="form-group">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-textarea"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Prix (DA)</label>
                <input type="number" step="0.01" name="prix" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Catégorie</label>
                <select name="categorie_id" class="form-select" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-file">
            </div>

            <button type="submit" class="submit-button">Enregistrer</button>
        </form>
    </div>
</x-app-layout>

<style>
    /* Form container */
    .form-container {
        max-width: 36rem;
        margin: 0 auto;
        padding: 1rem 1.5rem;
    }
    
    /* Form title */
    .form-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #1f2937;
    }
    
    /* Form layout */
    .product-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    /* Form groups */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    
    /* Labels */
    .form-label {
        font-weight: 600;
        color: #374151;
    }
    
    /* Input fields */
    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
        line-height: 1.5;
    }
    
    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
    }
    
    /* Textarea specific */
    .form-textarea {
        min-height: 6rem;
        resize: vertical;
    }
    
    /* File input */
    .form-file {
        width: 100%;
        padding: 0.5rem 0;
    }
    
    /* Submit button */
    .submit-button {
        padding: 0.5rem 1rem;
        background-color: #16a34a;
        color: white;
        font-weight: 500;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .submit-button:hover {
        background-color: #15803d;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .form-container {
            padding: 0.75rem 1rem;
        }
        
        .form-title {
            font-size: 1.25rem;
        }
    }
</style>
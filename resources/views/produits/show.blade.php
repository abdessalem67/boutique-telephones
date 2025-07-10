<x-app-layout>
    <div class="product-show-container">
        <div class="product-card">
            {{-- Product title --}}
            <h2 class="product-title">{{ $produit->nom }}</h2>

            {{-- Product image --}}
            @if($produit->image)
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $produit->image) }}" 
                         alt="{{ $produit->nom }}" 
                         class="product-image">
                </div>
            @endif

            {{-- Product details --}}
            <div class="product-details">
                <p class="product-detail">
                    <span class="detail-label">Prix :</span>
                    {{ number_format($produit->prix, 2) }} DA
                </p>
                <p class="product-detail">
                    <span class="detail-label">Stock :</span>
                    {{ $produit->stock }}
                </p>
                <p class="product-detail">
                    <span class="detail-label">Catégorie :</span>
                    {{ $produit->categorie->nom }}
                </p>
            </div>

            {{-- Back button --}}
            <div class="back-button-container">
                <a href="{{ route('produits.index') }}" class="back-button">
                    ← Retour à la liste
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* Base container */
    .product-show-container {
        max-width: 56rem;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
    }
    
    /* Product card */
    .product-card {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    /* Product title */
    .product-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    /* Product image */
    .product-image-container {
        display: flex;
        justify-content: center;
        margin: 1rem 0;
    }
    
    .product-image {
        width: 7rem;
        height: 7rem;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    /* Product details */
    .product-details {
        color: #374151;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .product-detail {
        line-height: 1.5;
    }
    
    .detail-label {
        font-weight: 500;
        color: #111827;
    }
    
    /* Back button */
    .back-button-container {
        padding-top: 1rem;
    }
    
    .back-button {
        display: inline-block;
        background-color: #2563eb;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }
    
    .back-button:hover {
        background-color: #1d4ed8;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .product-show-container {
            padding: 1.5rem 1rem;
        }
        
        .product-title {
            font-size: 1.5rem;
        }
        
        .product-image {
            width: 5rem;
            height: 5rem;
        }
    }
</style>
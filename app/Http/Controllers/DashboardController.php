<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;

class DashboardController extends Controller
{
    public function index()
    {
        // Nombre total de produits
        $totalProduits = Produit::count();

        // Récupérer toutes les catégories avec leur nombre de produits
        $categories = Categorie::withCount('produits')->get();

        // Récupérer les derniers produits avec leur catégorie
        $produits = Produit::with('categorie')->latest()->take(8)->get();

        return view('dashboard', [
            'totalProduits' => $totalProduits,
            'categories' => $categories,
            'produits' => $produits, // ➕ ligne ajoutée
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    // Champs modifiables en masse (mass assignment)
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'stock',
        'categorie_id',
        'image',
    ];

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}

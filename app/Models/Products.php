<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory as FactoriesHasFactory;

class Products extends Model
{
    use FactoriesHasFactory;
    protected $fillable = ['name', 'description', 'price', 'image'];
    //Relation avec le commentaire 
    public function comments()
{
    return $this->hasMany(Comment::class);
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  // Assure-toi d'importer cette classe
use App\Models\Products;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CommentController extends Controller
{
     // Utilisez le trait ici
     use AuthorizesRequests;

     /**
     * Enregistrer un nouveau commentaire.
     */
    public function store(Request $request, Products $product)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $product->comments()->create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Commentaire modifié avec succès.');
    }

    public function destroy(Comment $comment)
{
    // Vérifie si l'utilisateur actuel est l'auteur du commentaire
    if ($comment->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer ce commentaire.');
    }

    // Supprimer le commentaire
    $comment->delete();

    // Retourner à la page précédente avec un message de succès
    return redirect()->back()->with('success', 'Commentaire supprimé avec succès.');
}

 
}

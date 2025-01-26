<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{/**
     * Détermine si l'utilisateur peut créer un commentaire.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function create(User $user)
    {
        return $user->id !== null; // Un utilisateur connecté peut commenter
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour un commentaire.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id; // Un utilisateur peut modifier son propre commentaire
    }

    /**
     * Détermine si l'utilisateur peut supprimer un commentaire.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id; // Un utilisateur peut supprimer son propre commentaire
    }
}
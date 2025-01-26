<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Comment;
use App\Policies\CommentPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistre les politiques de l'application.
     *
     * @return void
     */
    public function boot()
    {
        // Cette méthode devrait être dans AuthServiceProvider et non dans AppServiceProvider
    }
}

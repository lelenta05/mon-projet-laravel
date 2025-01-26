<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les politiques d'accès (policies) du projet.
     *
     * @var array
     */
    protected $policies = [
        // Enregistre la politique pour le modèle Comment
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Enregistre les politiques d'accès.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();  // Cette méthode devrait fonctionner, même sous Laravel 11.
        
        // Si la méthode $this->registerPolicies() ne fonctionne pas, tu peux enregistrer les politiques manuellement :
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}

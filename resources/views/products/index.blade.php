<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Liste des produits' }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Header -->
    <header class="bg-primary text-white py-3">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="#" class="navbar-brand text-white fw-bold fs-3">E-commerce</a>
            <!-- Formulaire de recherche -->
            <form action="{{ route('products.search') }}" method="GET" class="d-flex me-3">
                <input class="form-control me-2" type="search" name="query" placeholder="Recherche un produit" aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-light" type="submit">Recherche</button>
            </form>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('dashboard')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('products.create') }}">Ajouter un Produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('products.index')}}">Voir les produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('products.search')}}">Recherche un produit par son nom</a>
                    </li>
                </ul>

                <!-- Connexion / Inscription / Déconnexion -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <!-- Utilisateur connecté -->
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="#">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <!-- Utilisateur non connecté -->
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container py-5 flex-grow-1">
        <!-- Liste des produits -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm h-100">
                        <!-- Image du produit -->
                        @if ($product->image)
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                class="card-img-top img-fluid" 
                                alt="{{ $product->name }}" 
                                style="height: 200px; object-fit: contain;">
                        @else
                            <div class="card-img-top bg-light text-center py-5">
                                <span class="text-muted">Aucune image disponible</span>
                            </div>
                        @endif

                        <!-- Contenu de la carte -->
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <p class="card-text fw-bold text-success">{{ number_format($product->price, 2) }} €</p>
                             <!-- Bouton Modifier -->
                            
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                          
                            <!-- Commentaires -->
                            <h6 class="mt-4">Commentaires :</h6>
                            <ul class="list-group list-group-flush">
                                @foreach ($product->comments as $comment)
                                    <li class="list-group-item">
                                        <p>{{ $comment->content }}</p>
                                        <small class="text-muted">Par {{ $comment->user->name }}, {{ $comment->created_at->diffForHumans() }}</small>

                                        @if (auth()->id() == $comment->user_id)
                                            <form action="{{ route('comment.update', $comment) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="content" class="form-control mb-2">{{ $comment->content }}</textarea>
                                                <button type="submit" class="btn btn-success btn-sm">Modifier</button>
                                            </form>

                                            <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Formulaire d'ajout de commentaire -->
                            @auth
                                <form action="{{ route('comment.store', $product) }}" method="POST" class="mt-3">
                                    @csrf
                                    <textarea name="content" class="form-control mb-2" placeholder="Ajouter un commentaire..." rows="2" required></textarea>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="mb-0">© 2025 E-Commerce Site | All rights reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

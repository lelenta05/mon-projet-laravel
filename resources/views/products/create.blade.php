<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Design</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Carte pour le formulaire -->
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Ajouter un produit</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Nom du produit -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du produit :</label>
                                <input type="text" id="name" name="name" required class="form-control">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description :</label>
                                <textarea id="description" name="description" required class="form-control" rows="3"></textarea>
                            </div>

                            <!-- Prix -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Prix :</label>
                                <input type="number" step="0.01" id="price" name="price" required class="form-control">
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Image :</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                            <!-- Bouton -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Footer -->
     <footer class="bg-primary text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="mb-0">© 2025 E-Commerce Site | All rights reserved</p>
        </div>
    </footer>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

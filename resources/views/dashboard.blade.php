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
            @auth
            <form action="{{ route('products.search') }}" method="GET" class="d-flex me-3">
                <input class="form-control me-2" type="search" name="query" placeholder="Recherche un produit" aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-light" type="submit">Recherche</button>     
            </form>
            @endauth
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
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('products.create') }}">Ajouter un Produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('products.index')}}">Voir les produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('products.search')}}">Recherche un produit par son nom</a>
                    </li>
                    @endauth
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

    <!-- Main Content -->
    <main class="container py-5">
        @auth
            <!-- Section pour les utilisateurs connectés -->
            <h1 class="mb-4">Bienvenue, {{ Auth::user()->name }}!</h1>
            <p class="text-success">Accédez aux fonctionnalités ci-dessus pour gérer vos produits.</p>
            <h1>Nos produits</h1>
            <div class="row mt-3">
            <div class="col-4 d-flex justify-content-start">
                <div class="card">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/image6.jpg')}}" alt="image1" class="card-img-top" style="max-width: 100%; height: auto;">
                </div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="card">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/image2.png')}}" alt="image2" class="card-img-top" style="max-width: 100%; height: auto;">
                </div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <div class="card">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/image3.jpeg')}}" alt="image3" class="card-img-top" style="max-width: 100%; height: auto;">
                </div>
                </div>
            </div>
            </div>
        @endauth

        @guest
            <!-- Section pour les utilisateurs non connectés -->
            <div class="alert alert-warning text-center" role="alert">
                <strong>Veuillez vous connecter pour accéder à toutes les fonctionnalités.</strong>
            </div>
            <h1>Nos produits</h1>
            <div class="row mt-3">
            <div class="col-4 d-flex justify-content-start">
            <div class="card">
            <div class="d-flex justify-content-center">
                <img src="{{asset('img/image6.jpg')}}" alt="image1" class="card-img-top" style="max-width: 100%; height: auto;">
            </div>
            </div>
        </div>
        <div class="col-4 d-flex justify-content-center">
            <div class="card">
            <div class="d-flex justify-content-center">
                <img src="{{asset('img/image2.png')}}" alt="image2" class="card-img-top" style="max-width: 100%; height: auto;">
            </div>
            </div>
        </div>
        <div class="col-4 d-flex justify-content-end">
            <div class="card">
            <div class="d-flex justify-content-center">
                <img src="{{asset('img/image3.jpeg')}}" alt="image3" class="card-img-top" style="max-width: 100%; height: auto;">
            </div>
            </div>
        </div>
        </div>
        @endguest
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="mb-0">© 2025 E-Commerce Site | All rights reserved</p>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold">E-commerce</a>
            <nav class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Home</a>
                <a href="{{ route('products.create') }}" class="hover:underline">Ajouter un Produit</a>
                <a href="{{ route('products.index') }}" class="hover:underline">Voir les Produits</a>
                <a href="{{ route('products.search') }}" class="hover:underline">Recherche</a>
            </nav>
            <div>
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="ml-2 text-red-400 hover:underline">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                    <a href="{{ route('register') }}" class="ml-2 hover:underline">Inscription</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-12 px-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier le produit</h1>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-semibold">Nom du produit :</label>
                        <input type="text" id="name" name="name" value="{{ $product->name }}" required class="w-full mt-2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-semibold">Description :</label>
                        <textarea id="description" name="description" required class="w-full mt-2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="price" class="block text-gray-700 font-semibold">Prix :</label>
                        <input type="number" step="0.01" id="price" name="price" value="{{ $product->price }}" required class="w-full mt-2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300">
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block text-gray-700 font-semibold">Image :</label>
                        <input type="file" id="image" name="image" class="w-full mt-2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md focus:ring focus:ring-blue-300">
                            Modifier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-4">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2025 E-commerce Site | Tous droits réservés</p>
        </div>
    </footer>

</body>
</html>

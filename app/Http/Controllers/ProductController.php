<?php
namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request ;

class ProductController extends Controller
{ 
    // Afficher le formulaire pour ajouter un produit
    public function create()
    {
        return view('products.create'); // Affiche le formulaire d'ajout
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        // Validation des données et enregistrement
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        // Gérer l'image si elle est présente
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index'); // Redirige vers la page des produits après l'ajout
    }
    

  

    // Afficher le formulaire pour modifier un produit
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    // Méthode pour mettre à jour un produit
    public function update(Request $request, Products $product)
    {
        // Validation des données et mise à jour
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        // Gérer l'image si elle est présente
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index'); // Redirige vers la page des produits après la modification
    }
      #affichag des tous les produits 
      public function index()
      {
          $products = Products::all(); // Récupérer tous les produits         
          return view('products.index', compact('products'));
      }

      public function search(Request $request)
      {
          // Récupérer le terme de recherche depuis la barre de recherche (input)
          $search_txt = $request->input('search');
  
          // Vérifier si un terme de recherche a été entré
          if ($search_txt) {
              // Effectuer la recherche par le nom du produit (insensible à la casse)
              $products = Products::where('name', 'like', '%' . $search_txt . '%')->get();
          } else {
              // Si aucun terme n'est fourni, on récupère tous les produits
              $products = Products::all();
          }
  
          // Retourner les résultats à la vue
          return view('products.search', compact('products', 'search_txt'));
      }
}
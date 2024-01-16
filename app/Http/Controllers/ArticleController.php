<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Categorie;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index(Request $request)
     {
         $category = $request->input('category');
         
         if ($category) {
             $articles = Article::whereHas('sousCategorie.categorie', function ($query) use ($category) {
                 $query->where('nomCategorie', $category);
             })->get();
     
             // Calculer la quantité et la valeur pour la catégorie sélectionnée
             $totalQuantity = $articles->sum('stock');
             $totalValue = $articles->reduce(function ($carry, $article) {
                 return $carry + ($article->stock * $article->prixTTC);
             }, 0);
         } else {
             $articles = Article::all();
             $totalQuantity = Article::sum('stock');
             $totalValue = Article::all()->reduce(function ($carry, $article) {
                 return $carry + ($article->stock * $article->prixTTC);
             }, 0);
         }
     
         $categories = Categorie::all();
         return view('articles.index', compact('articles', 'categories', 'totalQuantity', 'totalValue'));
     }
     

     public function search(Request $request)
     {
         $query = $request->input('query');
         $articles = Article::where('nomArticle', 'like', "%$query%")->get();
     
         // Récupérer toutes les catégories pour les passer à la vue
         $categories = Categorie::all();
     
         // Calculer la quantité totale en stock et la valeur totale des stocks
         $totalQuantity = $articles->sum('stock');
         $totalValue = $articles->reduce(function ($carry, $article) {
             return $carry + ($article->stock * $article->prixTTC); // Remplacez 'prixTTC' par le nom de votre champ de prix dans la base de données
         }, 0);
     
         return view('articles.index', compact('articles', 'categories', 'totalQuantity', 'totalValue'));
     }
     
     
     



    public function create()
    {
        return view('');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {

        $article=Article::where('slug',$slug)->firstOrFail();
        $stock=$article->stock===0 ?'indisponible':'disponible';
        
        return view('show',[
            'article'=>$article,
            'stock'=>$stock
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

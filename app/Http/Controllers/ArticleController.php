<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    //Affiche la liste des articles (Ajout)
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


    
    //Affiche la liste des articles (Retour)
    public function index_retour(Request $request)
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
        return view('articles.index_retour', compact('articles', 'categories', 'totalQuantity', 'totalValue'));
    }


    //recherche d'articles
    public function search(Request $request)
    {
        $query = $request->input('query');
        $articles = Article::where('nomArticle', 'like', "%$query%")->get();
        

        // Récupérer toutes les catégories pour les passer à la vue
        $categories = Categorie::all();

        // Calculer la quantité totale en stock et la valeur totale des stocks
        $totalQuantity = $articles->sum('stock');
        $totalValue = $articles->reduce(function ($carry, $article) {
            return $carry + ($article->stock * $article->prixTTC); 
        }, 0);

        return view('articles.index', compact('articles', 'categories', 'totalQuantity', 'totalValue'));
    }

    //Affiche les détails d'un article spécifique
    public function show($slug)
    {

        $article = Article::where('slug', $slug)->firstOrFail();
        $stock = $article->stock === 0 ? 'indisponible' : 'disponible';

        return view('show', [
            'article' => $article,
            'stock' => $stock
        ]);
    }



    // ArticleController.php
    public function fetchArticleByRef($ref)
    {
        $article = Article::where('reference', $ref)->first();
        if ($article) {
            return response()->json($article);
        } else {
            return response()->json(['message' => 'Article non trouvé'], 404);
        }
    }
   
   
   

}

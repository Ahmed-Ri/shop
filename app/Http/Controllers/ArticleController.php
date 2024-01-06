<?php

namespace App\Http\Controllers;


use App\Models\Article;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$articles = Article::with(['sousCat', 'sousCat.cat', 'article_commande'])->get();
        $articles = Article::all();
            //dd($articles);
            //dd(Cart::content());
        return view('articles.index', compact('articles'));    }

    /**
     * Show the form for creating a new resource.
     */public function search(Request $request)
{
    $query = $request->input('query');
    $articles = Article::where('nomArticle', 'like', "%$query%")
                        
                        ->get();

    return view('articles.index', compact('articles'));
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

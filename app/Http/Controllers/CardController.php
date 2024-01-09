<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\Article;
use App\Models\MontantLibre;
use Gloudemans\Shoppingcart\Facades\Cart;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Psy\Readline\Hoa\Console;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = Article::find($request->id_article);
        if ($article) {
        $duplicata = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->id_article;
        });
        if ($duplicata->isNotEmpty()) {
            return redirect()->route('articles.index')->with('success', 'le article a déja été ajouté' . ' (' . Cart::count() . ' articles)');
        }
        if ($article->stock == 0) {
            return redirect()->route('articles.index')->withErrors(['error' => 'Article indisponible !']);
        }

        //dd($request->id,$request->nomArticle,$request->prix);
        Cart::add($article->id, $article->nomArticle, 1, $article->prixTTC)->associate('App\Models\Article');
        //Cart::add(['id' => $article->id, 'nomArticle' => $article->nomArticle, 'qty' => 1, 'prix' =>$article->prix]);
    }
    elseif ($request->type === 'montantLibre') {
                // Ajouter un MontantLibre
                // $validatedData = $request->validate([
                //     'nomProduit' => 'required|string',
                //     'montant' => 'required|numeric',
                //     'origineDeVente' => 'required|string',
                //     'categorie' => 'required|string',
                //     // Autres règles de validation
                // ]);
                try {
                    $montantLibre = MontantLibre::create([
                        'nomArticle' => $request->nomProduit,
                        'prixTTC' => $request->montant,
                        'OrigineDeVente' => $request->origineDeVente,
                        'categorie' => $request->categorie,
                        // Autres champs nécessaires
                    ]);
                } catch (\Exception $e) {
                    // Gérer l'exception
                }
                
        
                // Vérifier si MontantLibre a été créé avec succès avant de l'ajouter au panier
                
                    Cart::add($montantLibre->id, $montantLibre->nomArticle, 1, $montantLibre->prixTTC);
            }


        return redirect()->route('articles.index')->with('success', 'le article a été ajouté ');
    }
    // public function store(Request $request)
    // {
    //     // Vérifier le type de soumission : article régulier ou MontantLibre
    //     if ($request->type === 'article') {
    //         // Ajouter un article de la table 'articles'
    //         $article = Article::find($request->id_article);
    //         if ($article) {
    //             $duplicata = Cart::search(function ($cartItem, $rowId) use ($request) {
    //                 return $cartItem->id == $request->id_article;
    //             });
    //             if ($duplicata->isNotEmpty()) {
    //                 return redirect()->route('articles.index')->with('success', 'le article a déja été ajouté' . ' (' . Cart::count() . ' articles)');
    //             }
    //             if ($article->stock == 0) {
    //                 return redirect()->route('articles.index')->withErrors(['error' => 'Article indisponible !']);
    //             }
        
    //             //dd($request->id,$request->nomArticle,$request->prix);
    //             Cart::add($article->id, $article->nomArticle, 1, $article->prixTTC)->associate('App\Models\Article');
    //         }
    //     } elseif ($request->type === 'montantLibre') {
    //         // Ajouter un MontantLibre
    //         $montantLibre = MontantLibre::create([
    //             'nomArticle' => $request->nomProduit,
    //             'prixTTC' => $request->montant,
    //             'OrigineDeVente' => $request->origineDeVente,
    //             'categorie' => $request->categorie,
    //             // Autres champs nécessaires
    //         ]);
    
    //         // Vérifier si MontantLibre a été créé avec succès avant de l'ajouter au panier
    //         if ($montantLibre) {
    //             Cart::add($montantLibre->id, $montantLibre->nomArticle, 1, $montantLibre->prixTTC);
    //         }
    //     }
    
    //     return redirect()->route('articles.index')->with('success', 'Article ajouté au panier.');
    // }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();
        $validates = Validator::make($request->all(), [
            'qty' => 'numeric|required|between:1,3',
        ]);

        if ($validates->fails()) {
            Session::flash('error', 'La quantité doit est comprise entre 1 et 3.');
            return response()->json(['error' => 'Cart Quantity Has Not Been Updated']);
        }

        if ($data['qty'] > $data['stock']) {
            Session::flash('error', 'Il n\'y a plus assez de stock.');
            return response()->json(['error' => 'Not Enought Product Quantity']);
        }
        Cart::update($rowId, $data['qty']);

        Session::flash('success', 'La quantité du produit est passée à ' . $data['qty'] . '.');
        return response()->json(['success' => 'Cart Quantity Has Been Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function clearCart()
    // {
    //     Cart::destroy(); // Clears the cart
    //     // You can add additional logic or response as needed
    //     return response()->json(['message' => 'Cart cleared successfully']);
    // }
    // Add this method to your CardController
    // public function clearCart()

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success', 'Le produit a ete supprimer');
    }
    
      
}

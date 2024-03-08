<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\Article;
use App\Models\Depense;
use App\Models\MontantLibre;
use App\Models\Retour;
use Gloudemans\Shoppingcart\Facades\Cart;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart.index');
    }
   
    public function retour_Montant_Libre(Request $request)
    {
        // Valider les données reçues
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'nomProduit' => 'required|string',
            'categorie' => 'required|string',
        ]);

        // Créer une nouvelle retour
        Retour::create([
            'nomArticle' => $validatedData['nomProduit'],
            'MontantRetour' => $validatedData['montant'],
            'categorieRetour' => $validatedData['categorie'],
        ]);
        return redirect()->route('card.index')->with('success', 'Le retour a été ajouter ');
    }
    public function getHistoriqueRetours()
    {
        $retours = Retour::all();
        return response()->json($retours);
    }



    public function store(Request $request)
    {
        // Gestion des articles normaux
        if ($request->has('id_article')) {
            $article = Article::find($request->id_article);

            if (!$article) {
                return redirect()->route('articles.index')->withErrors(['error' => 'Article non trouvé !']);
            }

            $cartItem = Cart::search(function ($cartItem, $rowId) use ($article) {
                return $cartItem->id == $article->id;
            })->first();

            if ($cartItem) {
                // Vérifier si l'ajout dépasse le stock disponible
                if ($cartItem->qty < $article->stock) {
                    Cart::update($cartItem->rowId, $cartItem->qty + 1);
                } else {
                    return redirect()->route('articles.index')->withErrors(['error' => 'Vous avez dépassé le stock disponible.']);
                }
            } else {
                if ($article->stock > 0) {
                    Cart::add($article->id, $article->nomArticle, 1, $article->prixTTC)->associate('App\Models\Article');
                } else {
                    return redirect()->route('articles.index')->withErrors(['error' => 'Article indisponible !']);
                }
            }
        } elseif ($request->type === 'montantLibre') {
            // Gestion des montants libres
            try {
                $montantLibre = MontantLibre::create([
                    'nomArticle' => $request->nomProduit,
                    'prixTTC' => $request->montant,
                    'OrigineDeVente' => $request->origineDeVente,
                    'categorie' => $request->categorie,
                    // Autres champs nécessaires
                ]);

                Cart::add($montantLibre->id, $montantLibre->nomArticle, 1, $montantLibre->prixTTC, ['maxQty' => 15]);
            } catch (\Exception $e) {
                return redirect()->route('articles.index')->withErrors(['error' => 'Erreur lors de l\'ajout du montant libre.']);
            }
        }


        return redirect()->route('articles.index')->with('success', 'Article ajouté à la caisse');
    }

    //retour Article
    public function retourArticle(Request $request)
{
    // Assurez-vous que l'ID de l'article est transmis
    if (!$request->has('id_article')) {
        return redirect()->route('articles.index')->withErrors(['error' => 'ID de l\'article manquant.']);
    }

    $articleId = $request->id_article;
    $article = Article::find($articleId);

    if (!$article) {
        return redirect()->route('articles.index')->withErrors(['error' => 'Article non trouvé !']);
    }
    $cartItem = Cart::search(function ($cartItem, $rowId) use ($articleId) {
        return $cartItem->id == $articleId;
    })->first();

    // Vérifier si l'article est dans le panier
    if ($cartItem) {
        // Si la quantité est plus que 1, décrémentez-la
        if ($cartItem->qty > 1) {
            Cart::update($cartItem->rowId, $cartItem->qty - 1);
        } else {
            // Si la quantité est 1, retirez l'article du panier
            Cart::remove($cartItem->rowId);
        }    
        return redirect()->route('articles.index');
    } else {
        // Ajouter l'article avec un prix TTC négatif
        Cart::add($article->id, $article->nomArticle, 1, -1 * $article->prixTTC)->associate('App\Models\Article');
        return redirect()->route('articles.index');}
}

public function AjoutArticle(Request $request)
{
    // Assurez-vous que l'ID de l'article est transmis
    if (!$request->has('id_article')) {
        return redirect()->route('articles.index')->withErrors(['error' => 'ID de l\'article manquant.']);
    }

    $articleId = $request->id_article;
    $article = Article::find($articleId);

    if (!$article) {
        return redirect()->route('articles.index')->withErrors(['error' => 'Article non trouvé !']);
    }

    // Rechercher si l'article est déjà dans le panier
    $cartItem = Cart::search(function ($cartItem, $rowId) use ($articleId) {
        return $cartItem->id == $articleId;
    })->first();

    if ($cartItem) {
        // Si l'article est déjà dans le panier, augmentez sa quantité
        Cart::update($cartItem->rowId, $cartItem->qty + 1);
    } else {
        // Si l'article n'est pas dans le panier, ajoutez-le avec une quantité de 1 et son prix TTC
        Cart::add($article->id, $article->nomArticle, 1, $article->prixTTC)->associate('App\Models\Article');
    }

    // Rediriger vers la page du panier ou une autre page avec un message de succès
    return redirect()->route('articles.index')->with('success', 'Article ajouté au panier avec succès !');
}




   
   //Modification de la quantité
    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();
        $validates = Validator::make($request->all(), [
            'qty' => 'numeric|required|between:1,100',
        ]);

        if ($validates->fails()) {
            Session::flash('error', 'La quantité doit est comprise entre 1 et 100.');
            return response()->json(['error' => 'Cart Quantity Has Not Been Updated']);
        }

        if ($data['qty'] > $data['stock']) {
            Session::flash('error', 'Il n\'y a plus assez de stock.');
            return response()->json(['error' => 'Not Enought Product Quantity']);
        }
        Cart::update($rowId, $data['qty']);

        Session::flash('success', "La quantité de l'article est passée à " . $data['qty'] . '.');
        return response()->json(['success' => 'Cart Quantity Has Been Updated']);
    }

   //Ajout dépenses
    public function Ajout_depense(Request $request)
    {
        // Valider les données reçues
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'nomProduit' => 'required|string',
            'categorie' => 'required|string',
        ]);

        // Créer une nouvelle dépense
        Depense::create([
            'nomDepense' => $validatedData['nomProduit'],
            'MtDepense' => $validatedData['montant'],
            'CategorieDepense' => $validatedData['categorie'],
        ]);
        return redirect()->route('card.index')->with('success', 'La dépense à été ajouter ');
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success', "L'article à été supprimer");
    }
    // public function clearCart()
    // {
    //     Cart::destroy(); // Clears the cart
    //     // You can add additional logic or response as needed
    //     return response()->json(['message' => 'Cart cleared successfully']);
    // }
    
}

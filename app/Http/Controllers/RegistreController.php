<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Registre;
use App\Models\SousCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\Commande;
use App\Models\MontantLibre;

class RegistreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('registre.paiement');
        // $commandes = Commande::all();
        // return view('commandes.index', compact('commandes'));
    }
    public function indexTicket()
    {
        return view('registre.ticket');
    }


    // public function paiement(Request $request)
    // {
    //     $commande = new Commande();
    //     $commande->nomArticle = '...'; // Set the appropriate fields
    //     $commande->MtCommandeTTC = Cart::subtotal();
    //     $commande->QteArticleTotal = Cart::count();
    //     $commande->save();
    //     foreach (Cart::content() as $item) {
    //         if ($item->model) {
    //             $article = Article::find($item->model->id);
    //             if ($article) {
    //                 $sousCategorie = $article->sousCategorie;
    //                 $Categorie = $article->sousCategorie->Categorie;
    //                 $article->update(['stock' => $article->stock - $item->qty]);

    //                 $registre = new Registre();
    //                 $registre->nomArticle = $item->model->nomArticle;
    //                 $registre->idArticle = $item->model->id;
    //                 $registre->idCommande = $commande->id;
    //                 $registre->designation = $article->designation;
    //                 $registre->image = $article->image;
    //                 $registre->marque = $article->marque;
    //                 $registre->stock = $article->stock;
    //                 $registre->prixHT = $article->prixHT;
    //                 $registre->stock = $article->stock;
    //                 $registre->TVA = $article->TVA;
    //                 $registre->prixTTC = $article->prixTTC;
    //                 $registre->MtCommandeTTC = Cart::subtotal();
    //                 $registre->QteArticleTotal = Cart::count();
    //                 $registre->quantitéArticle = $item->qty;
    //                 $registre->MoyenDePaiement = $article->MoyenDePaiement;
    //                 $registre->OrigineDeVente = $article->OrigineDeVente;
    //                 $registre->categorie = $Categorie->nomCategorie;
    //                 $registre->SousCategorie = $sousCategorie->nomSousCategorie;


    //                 // Set other fields as necessary
    //                 $registre->save();
    //             }
    //         }

    //         // Clears the cart
    //         // return response()->json(['message' => 'Cart cleared successfully']);      
    //     }
    //     Cart::destroy();
    //     return redirect()->route('paiement')->with('success', 'Paiement éffectué');
    // }
    public function paiement(Request $request)
    {
         // Récupération du moyen de paiement
    $moyenDePaiement = $request->input('moyenDePaiement');
        // Création de la commande
        $commande = new Commande();
        $commande->nomArticle = '...'; // Définir les champs appropriés
        $commande->MtCommandeTTC = Cart::subtotal();
        $commande->QteArticleTotal = Cart::count();
        $commande->save();

        // Parcours des éléments dans le panier
        foreach (Cart::content() as $item) {
            $registre = new Registre();
            $registre->idCommande = $commande->id;

            // Traitement pour un article
            if ($item->model instanceof Article) {
                //dd($item->model->nomArticle);
                $article = Article::find($item->model->id);
                if ($article) {
                    $sousCategorie = $article->sousCategorie;
                    $Categorie = $article->sousCategorie->Categorie;
                    $article->update(['stock' => $article->stock - $item->qty]);

                    // Configuration du registre pour un article
                    $registre->idArticle = $article->id;
                    $registre->nomArticle = $item->model->nomArticle;
                    $registre->designation = $article->designation;
                    $registre->image = $article->image;
                    $registre->marque = $article->marque;
                    $registre->stock = $article->stock;
                    $registre->prixHT = $article->prixHT;
                    $registre->stock = $article->stock;
                    $registre->TVA = $article->TVA;
                    $registre->prixTTC = $article->prixTTC;
                    $registre->MtCommandeTTC = Cart::subtotal();
                    $registre->QteArticleTotal = Cart::count();
                    $registre->quantitéArticle = $item->qty;
                    $registre->MoyenDePaiement = $moyenDePaiement;
                    $registre->OrigineDeVente = $article->OrigineDeVente;
                    $registre->categorie = $Categorie->nomCategorie;
                    $registre->SousCategorie = $sousCategorie->nomSousCategorie;
                    // Définir les autres champs nécessaires pour l'article
                    // ...
                }
            }

            // Traitement pour un montant libre
            else {
                $montantLibre = MontantLibre::find($item->id);
                
                if ($montantLibre) {
                    //dd($montantLibre->nomArticle, $montantLibre->prixTTC);
                    //$sousCategorie = $montantLibre->sousCategorie;
                    //$Categorie = $montantLibre->sousCategorie->Categorie;
                    
                    
                    // Configuration du registre pour un montant libre
                    $registre->idMontantLibre = $montantLibre->id;
                    $registre->nomArticle = $montantLibre->nomArticle;
                    $registre->prixTTC = $montantLibre->prixTTC;
                    $registre->OrigineDeVente = $montantLibre->OrigineDeVente;
                    $registre->quantitéArticle = 1;
                    $registre->QteArticleTotal = Cart::count();
                    $registre->MtCommandeTTC = Cart::subtotal();
                    $registre->MoyenDePaiement = $moyenDePaiement;
                    $registre->categorie = $montantLibre->categorie;
                    // Définir les autres champs nécessaires pour le montant libre
                    
                }
            }

            $registre->save();
        }

        // Vider le panier
        Cart::destroy();
// Confirmez la transaction
        DB::commit();
        
                // Retournez une réponse de succès
                
             
        return response()->json(['success' => 'Paiement effectué avec succès.']);
    }
    // $commande=new Commande();
    // $commande->nomArticle=$article->nomArticle;
    // $commande->QteArticleTotal=Cart::count();
    // $commande->MtCommandeTTC=getPrice(Cart::subtotal());




    // // $registre=new Registre();
    // // // $registre->reference=Cart::count();
    // // // $registre->origineVente=$Categorie->nomCategorie;
    // // // $registre->slug=$sousCategorie->nomSousCategorie;
    // // $registre->nomArticle=$article->nomArticle;
    // // $registre->designation=$article->designation;
    // // $registre->image=$article->image;
    // // $registre->marque=$article->marque;
    // // $registre->stock=$article->stock;
    // // $registre->prixHT=$article->prixHT;
    // // $registre->stock=$article->stock;
    // // $registre->TVA=$article->TVA;
    // // $registre->prixTTC=$article->prixTTC;
    // // $registre->MtCommandeTTC=getPrice(Cart::subtotal());
    // // $registre->QteArticleTotal=Cart::count();
    // // $registre->MoyenDePaiement=$article->MoyenDePaiement;
    // // $registre->OrigineDeVente=$article->OrigineDeVente;
    // // $registre->categorie=$Categorie->nomCategorie;
    // // $registre->SousCategorie=$sousCategorie->nomSousCategorie;
    // // $registre->idArticle=$article->id;

    // $commande->save();


    // public function enregistrerPaiement(Request $request)
    // {
    //     $moyenDePaiement = $request->input('flexRadioDefault');

    //     $caisse = new Registre();
    //     $caisse->moyen = $moyenDePaiement;
    //     $caisse->save();
    //     return redirect()->route('articles.index')->with('success', 'Paiement éffectué');

    // }
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
        //
    }

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

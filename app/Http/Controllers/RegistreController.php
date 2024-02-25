<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Registre;

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

    //Methode de paiement
    public function paiement(Request $request)
    {
        // Récupération du moyen de paiement
        $moyenDePaiement = $request->input('moyenDePaiement');
        // Création de la commande
        $commande = new Commande();
        //$commande->nomArticle = '...'; // Définir les champs appropriés
        $commande->ref = 'CMD' . time(); // Définir les champs appropriés
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
                    // Gestion des retours d'articles
                    if ($item->price < 0) {
                        // Incrémenter le stock pour un article retourné
                        $article->stock += $item->qty;
                    } else {
                        // Décrémenter le stock pour un achat normal
                        $article->stock -= $item->qty;
                    }
                    $article->save();

                    // Configuration du registre pour un article
                    $registre->idArticle = $article->id;
                    $registre->RefCommande = $commande->ref;
                    $registre->RefArticle = $article->reference;

                    $registre->nomArticle = $item->model->nomArticle;
                    
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
                }
            }

            // Traitement pour un montant libre
            else {
                $montantLibre = MontantLibre::find($item->id);

                if ($montantLibre) {

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
                }
            }

            $registre->save();
        }

        // Vider le panier
        Cart::destroy();
        // Confirmez la transaction
        DB::commit();
        return response()->json(['success' => 'Paiement effectué avec succès.']);
    }
}

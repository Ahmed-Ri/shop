<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Registre;
use App\Models\SousCategorie;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\Commande;

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
    
   
    public function paiement()
    {
        $commande = new Commande();
        $commande->nomArticle = '...'; // Set the appropriate fields
        $commande->MtCommandeTTC = Cart::subtotal();
        $commande->QteArticleTotal = Cart::count();
        $commande->save();
        foreach (Cart::content() as $item) {
            $article = Article::find($item->model->id);
            $sousCategorie = $article->sousCategorie;
            $Categorie = $article->sousCategorie->Categorie;
            $article->update(['stock' => $article->stock - $item->qty]);
           
            $registre = new Registre();
            $registre->nomArticle = $item->model->nomArticle;
            $registre->idArticle = $item->model->id;
            $registre->idCommande = $commande->id;
            $registre->designation=$article->designation;
        $registre->image=$article->image;
        $registre->marque=$article->marque;
        $registre->stock=$article->stock;
        $registre->prixHT=$article->prixHT;
        $registre->stock=$article->stock;
        $registre->TVA=$article->TVA;
        $registre->prixTTC=$article->prixTTC;
        $registre->MtCommandeTTC=Cart::subtotal();
        $registre->QteArticleTotal=Cart::count();
        $registre->quantitéArticle=$item->qty;
        $registre->MoyenDePaiement=$article->MoyenDePaiement;
        $registre->OrigineDeVente=$article->OrigineDeVente;
        $registre->categorie=$Categorie->nomCategorie;
        $registre->SousCategorie=$sousCategorie->nomSousCategorie;
            

            // Set other fields as necessary
            $registre->save();

            
        // Clears the cart
        // return response()->json(['message' => 'Cart cleared successfully']);      
        }
        Cart::destroy();
        return redirect()->route('paiement')->with('success', 'Paiement éffectué');

        
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

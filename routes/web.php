<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\RegistreController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;



//Article routes
Route::get('/catalogue', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/catalogue/retour', [ArticleController::class, 'index_retour'])->name('index.retour');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');
Route::get('/fetch-article/{ref}', [ArticleController::class, 'fetchArticleByRef']);


//Cart routes
Route::get('/', [CardController::class, 'index'])->name('card.index');
Route::post('/panier/ajouter', [CardController::class, 'store'])->name('card.store');
Route::post('/panier/retourArticle', [CardController::class, 'retourArticle'])->name('retourArticle');
Route::post('/panier/AjoutArticle', [CardController::class, 'AjoutArticle'])->name('AjoutArticle');


Route::post('/Depense/ajouter', [CardController::class, 'Ajout_depense'])->name('Ajout_depense');
Route::post('/Retour/ajouter', [CardController::class, 'retour_Montant_Libre'])->name('retour_Montant_Libre');
Route::get('/historique-retours', [CardController::class, 'getHistoriqueRetours']);
Route::post('/panier/{rowId}', [CardController::class, 'update'])->name('card.update');
Route::delete('/panier/{rowId}', [CardController::class, 'destroy'])->name('card.destroy');
//Registre routes
Route::get('/paiement', [RegistreController::class, 'index'])->name('registre.index');
Route::post('/paiement', [RegistreController::class, 'paiement'])->name('paiement');
Route::get('/Ticket', [RegistreController::class, 'indexTicket'])->name('registre.Ticket');
Route::post('/enregistrer-paiement', [RegistreController::class, 'enregistrerPaiement'])->name('enregistrerPaiement');
//Chart routes
Route::get('/graphique/recettes', [ChartController::class, 'recette']);
Route::get('/liste/recettes', [ChartController::class, 'recettes']);
Route::get('/graphique/depenses', [ChartController::class, 'depense']);
Route::get('/liste/depenses', [ChartController::class, 'depenses']);
Route::get('/graphique/RecetteDepense', [ChartController::class, 'Recettedepense']);
Route::get('/liste/RecetteDepense', [ChartController::class, 'Recettedepenses']);


Route::get('/daterange', function () {
    return view('daterange');
});


//vider panier
Route::get('/viderPanier', function () {
    Cart::destroy();
});


<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\RegistreController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layout');
// });
//Route::resource('/', ArticleController::class);

Route::resource('categories', CategorieController::class);
Route::resource('commandes', RegistreController::class);

Route::resource('paniers', CardController::class);

//Article routes
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
//Cart routes
Route::get('/paniers', [CardController::class, 'index'])->name('card.index');
Route::post('/panier/ajouter', [CardController::class, 'store'])->name('card.store');
Route::post('/panier/{rowId}', [CardController::class, 'update'])->name('card.update');

Route::delete('/panier/{rowId}', [CardController::class, 'destroy'])->name('card.destroy');

Route::get('/paiement', [RegistreController::class, 'index'])->name('registre.index');
Route::post('/paiement', [RegistreController::class, 'paiement'])->name('paiement');
Route::get('/Ticket', [RegistreController::class, 'indexTicket'])->name('registre.Ticket');
Route::post('/enregistrer-paiement', [RegistreController::class, 'enregistrerPaiement'])->name('enregistrerPaiement');

// Route::delete('/clearCart', [CardController::class, 'clearCart'])->name('card.clearCart');
// Route::post('/clearCart', [CardController::class, 'clearCart'])->name('card.clearCart');
// Add this route to your web.php file
//Route::delete('/clear-cart', 'CardController@clearCart')->name('clear.cart');
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');
Route::get('/graphique/recettes', [ChartController::class, 'recette']);
Route::get('/liste/recettes', [ChartController::class, 'recettes']);
Route::get('/graphique/depenses', [ChartController::class, 'depense']);
Route::get('/liste/depenses', [ChartController::class, 'depenses']);
Route::get('/graphique/RecetteDepense', [ChartController::class, 'Recettedepense']);
Route::get('/liste/RecetteDepense', [ChartController::class, 'Recettedepenses']);


Route::get('/daterange', function () {
    return view('daterange');
});



Route::get('/viderPanier', function () {
    Cart::destroy();
});

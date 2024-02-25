<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Depense;
use App\Models\Registre;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function categorieTrie(Request $request)
    // {
    //     // Récupérer toutes les catégories distinctes de la table registre
    //     $categories = Registre::distinct()->pluck('categorie');

    //     $categorieSelectionnee = $request->query('categorie');
    //     $periode = $request->query('periode', 'jour');

    //     // Définir le format et le groupement en fonction de la période
    //     switch ($periode) {
    //         case 'mois':
    //             $group = DB::raw('MONTH(created_at)');
    //             $format = '%Y-%m';
    //             break;
    //         case 'semaine':
    //             $group = DB::raw('YEARWEEK(created_at)');
    //             $format = '%Y-%u';
    //             break;
    //         case 'annee':
    //             $group = DB::raw('YEAR(created_at)');
    //             $format = '%Y';
    //             break;
    //         default:
    //             $group = DB::raw('DATE(created_at)');
    //             $format = '%Y-%m-%d';
    //             break;
    //     }

    //     $query = Registre::select(
    //         'categorie',
    //         DB::raw('sum(prixTTC) as total'), // Somme du prixTTC pour chaque catégorie
    //         DB::raw("DATE_FORMAT(created_at, '$format') as date")
    //     );

    //     if (!empty($categorieSelectionnee)) {
    //         $query->where('categorie', $categorieSelectionnee);
    //     }

    //     $query->groupBy('categorie', 'date');

    //     $registres = $query->get();

    //     return view('charts.recettes_depenses', compact('registres', 'periode', 'categories', 'categorieSelectionnee'));
    // }
    public function recette(Request $request)
    {
        // Récupération de la plage de dates
        $daterange = $request->input('daterange');
        // Convertir les dates dans le format approprié si nécessaire
        $dates = $daterange ? explode(' - ', $daterange) : [];
        $startDate = isset($dates[0]) ? Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d') : null;
        $endDate = isset($dates[1]) ? Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d') : null;

        // Définir la période
        $periode = $request->query('periode', 'jour');

        switch ($periode) {
            case 'mois':
                $group = DB::raw('MONTH(created_at)');
                $format = '%Y-%m';
                break;
            case 'semaine':
                $group = DB::raw('YEARWEEK(created_at)');
                $format = '%Y-%u';
                break;
            case 'annee':
                $group = DB::raw('YEAR(created_at)');
                $format = '%Y';
                break;
            case 'seconde':
                $group = DB::raw('SECOND(created_at)');
                $format = '%Y-%m-%d %H:%i:%s';
                break;
            default:
                $group = DB::raw('DATE(created_at)');
                $format = '%Y-%m-%d';
                break;
        }
        // Création de la requête de base
        $query = Commande::select(
            DB::raw('sum(MtCommandeTTC) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Groupement et obtention des données
        $commandes = $query->groupBy('date')->get();

        // Récupération des totaux par catégorie
        $totalParCategorie = Registre::select(
            DB::raw('sum(prixTTC*quantitéArticle) as total'),
            'categorie'
        )
            ->groupBy('categorie')
            ->get();

        // Retourner la vue avec les données filtrées
        return view('charts.graph.recettes', compact('commandes', 'periode', 'totalParCategorie'));
    }

    public function recettes(Request $request)
    {
        // Récupération de la plage de dates
        $daterange = $request->input('daterange');
        $dates = $daterange ? explode(' - ', $daterange) : [];
        $startDate = isset($dates[0]) ? Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d') : null;
        $endDate = isset($dates[1]) ? Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d') : null;

        $periode = $request->query('periode', 'jour');

        switch ($periode) {
            case 'mois':
                $group = DB::raw('MONTH(created_at)');
                $format = '%Y-%m';
                break;
            case 'semaine':
                $group = DB::raw('YEARWEEK(created_at)');
                $format = '%Y-%u';
                break;
            case 'annee':
                $group = DB::raw('YEAR(created_at)');
                $format = '%Y';
                break;
            case 'seconde':
                $group = DB::raw('SECOND(created_at)');
                $format = '%Y-%m-%d %H:%i:%s';
                break;
            default:
                $group = DB::raw('DATE(created_at)');
                $format = '%Y-%m-%d';
                break;
        }

        // Création de la requête de base
        $query = Commande::select(
            DB::raw('sum(MtCommandeTTC) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Groupement et obtention des données
        $commandes = $query->groupBy('date')->orderBy('date', 'desc')->get();

        // Récupération des totaux par catégorie
        $totalParCategorie = Registre::select(
            DB::raw('sum(prixTTC*quantitéArticle) as total'),
            'categorie'
        )
            ->groupBy('categorie')
            ->get();

        return view('charts.liste.recettesL', compact('commandes', 'periode', 'totalParCategorie'));
    }

    public function depense(Request $request)
    {
        // Récupération de la plage de dates
        $daterange = $request->input('daterange');
        $dates = $daterange ? explode(' - ', $daterange) : [];
        $startDate = isset($dates[0]) ? Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d') : null;
        $endDate = isset($dates[1]) ? Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d') : null;

        $periode = $request->query('periode', 'jour');

        switch ($periode) {
            case 'mois':
                $group = DB::raw('MONTH(created_at)');
                $format = '%Y-%m';
                break;
            case 'semaine':
                $group = DB::raw('YEARWEEK(created_at)');
                $format = '%Y-%u';
                break;
            case 'annee':
                $group = DB::raw('YEAR(created_at)');
                $format = '%Y';
                break;
            case 'seconde':
                $group = DB::raw('SECOND(created_at)');
                $format = '%Y-%m-%d %H:%i:%s';
                break;
            default:
                $group = DB::raw('DATE(created_at)');
                $format = '%Y-%m-%d';
                break;
        }

        // Récupération des montants totaux des depenses
        $depenses = Depense::select(
            DB::raw('sum(MtDepense) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié
        if ($startDate && $endDate) {
            $depenses->whereBetween('created_at', [$startDate, $endDate]);
        }

        $depenses = $depenses->groupBy('date')->get();

        $totalParCategorie = Depense::select(
            DB::raw('sum(MtDepense) as total'),
            'CategorieDepense'
        )
            ->groupBy('CategorieDepense')
            ->get();

        return view('charts.graph.depenses', compact('depenses', 'periode', 'totalParCategorie'));
    }

    public function depenses(Request $request)
    {
        // Récupération de la plage de dates
        $daterange = $request->input('daterange');
        $dates = $daterange ? explode(' - ', $daterange) : [];
        $startDate = isset($dates[0]) ? Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d') : null;
        $endDate = isset($dates[1]) ? Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d') : null;

        $periode = $request->query('periode', 'jour');

        switch ($periode) {
            case 'mois':
                $group = DB::raw('MONTH(created_at)');
                $format = '%Y-%m';
                break;
            case 'semaine':
                $group = DB::raw('YEARWEEK(created_at)');
                $format = '%Y-%u';
                break;
            case 'annee':
                $group = DB::raw('YEAR(created_at)');
                $format = '%Y';
                break;
            case 'seconde':
                $group = DB::raw('SECOND(created_at)');
                $format = '%Y-%m-%d %H:%i:%s';
                break;
            default:
                $group = DB::raw('DATE(created_at)');
                $format = '%Y-%m-%d';
                break;
        }

        // Récupération des montants totaux des depenses
        $depenses = Depense::select(
            DB::raw('sum(MtDepense) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié
        if ($startDate && $endDate) {
            $depenses->whereBetween('created_at', [$startDate, $endDate]);
        }

        $depenses = $depenses->groupBy('date')->orderBy('date', 'desc')->get();

        $totalParCategorie = Depense::select(
            DB::raw('sum(MtDepense) as total'),
            'CategorieDepense'
        )
            ->groupBy('CategorieDepense')
            ->get();

        return view('charts.liste.depensesL', compact('depenses', 'periode', 'totalParCategorie'));
    }

    ///Recettedepense

    public function Recettedepense(Request $request)
    {
        // Récupération de la plage de dates
        $daterange = $request->input('daterange');
        $dates = $daterange ? explode(' - ', $daterange) : [];
        $startDate = isset($dates[0]) ? Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d') : null;
        $endDate = isset($dates[1]) ? Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d') : null;

        $periode = $request->query('periode', 'jour');

        $periode = $request->query('periode', 'jour');

        switch ($periode) {
            case 'mois':
                $group = DB::raw('MONTH(created_at)');
                $format = '%Y-%m';
                break;
            case 'semaine':
                $group = DB::raw('YEARWEEK(created_at)');
                $format = '%Y-%u';
                break;
            case 'annee':
                $group = DB::raw('YEAR(created_at)');
                $format = '%Y';
                break;
            case 'seconde':
                $group = DB::raw('SECOND(created_at)');
                $format = '%Y-%m-%d %H:%i:%s';
                break;
            default:
                $group = DB::raw('DATE(created_at)');
                $format = '%Y-%m-%d';
                break;
        }

        // Récupérer les recettes
        $recettes = Commande::select(
            DB::raw('sum(MtCommandeTTC) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié pour les recettes
        if ($startDate && $endDate) {
            $recettes->whereBetween('created_at', [$startDate, $endDate]);
        }

        $recettes = $recettes->groupBy('date')->get();

        // Récupérer les dépenses
        $depenses = Depense::select(
            DB::raw('sum(MtDepense) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié pour les dépenses
        if ($startDate && $endDate) {
            $depenses->whereBetween('created_at', [$startDate, $endDate]);
        }

        $depenses = $depenses->groupBy('date')->get();

        return view('charts.graph.recettes_depenses', compact('recettes', 'depenses', 'periode'));
    }


    public function Recettedepenses(Request $request)
    {
        // Récupération de la plage de dates
        $daterange = $request->input('daterange');
        $dates = $daterange ? explode(' - ', $daterange) : [];
        $startDate = isset($dates[0]) ? Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d') : null;
        $endDate = isset($dates[1]) ? Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d') : null;

        $periode = $request->query('periode', 'jour');

        switch ($periode) {
            case 'mois':
                $group = DB::raw('MONTH(created_at)');
                $format = '%Y-%m';
                break;
            case 'semaine':
                $group = DB::raw('YEARWEEK(created_at)');
                $format = '%Y-%u';
                break;
            case 'annee':
                $group = DB::raw('YEAR(created_at)');
                $format = '%Y';
                break;
            case 'seconde':
                $group = DB::raw('SECOND(created_at)');
                $format = '%Y-%m-%d %H:%i:%s';
                break;
            default:
                $group = DB::raw('DATE(created_at)');
                $format = '%Y-%m-%d';
                break;
        }

        // Récupérer les recettes
        $recettes = Commande::select(
            DB::raw('sum(MtCommandeTTC) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié pour les recettes
        if ($startDate && $endDate) {
            $recettes->whereBetween('created_at', [$startDate, $endDate]);
        }

        $recettes = $recettes->groupBy('date')->orderBy('date', 'desc')->get()->keyBy('date');

        // Récupérer les dépenses
        $depenses = Depense::select(
            DB::raw('sum(MtDepense) as total'),
            DB::raw("DATE_FORMAT(created_at, '$format') as date")
        );

        // Appliquer le filtrage par dates si spécifié pour les dépenses
        if ($startDate && $endDate) {
            $depenses->whereBetween('created_at', [$startDate, $endDate]);
        }

        $depenses = $depenses->groupBy('date')->orderBy('date', 'desc')->get()->keyBy('date');

        // Combinez les recettes et les dépenses par date
        $dates = $recettes->keys()->merge($depenses->keys())->unique();
        $data = $dates->map(function ($date) use ($recettes, $depenses) {
            $totalRecettes = $recettes[$date]->total ?? 0;
            $totalDepenses = $depenses[$date]->total ?? 0;

            return [
                'date' => $date,
                'totalRecettes' => $totalRecettes . ' €',
                'totalDepenses' => $totalDepenses . ' €'
            ];
        })->sortByDesc('date');

        return view('charts.liste.recettes_depensesL', compact('data', 'periode'));
    }
}

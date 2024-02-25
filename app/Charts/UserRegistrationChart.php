<?php

namespace App\Charts;

use App\Models\Registre;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class UserRegistrationChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->labels(['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']);

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = Registre::whereMonth('created_at', $i)->count();
        }

        $this->dataset('Inscriptions par Mois', 'bar', $data);
    }
}

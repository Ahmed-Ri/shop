<?php
function getPrice($prix){
    $prixTTC=floatval($prix);
    return number_format($prixTTC, 2, ',', '') . ' €';
}
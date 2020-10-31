<?php
/**
 * Created by PhpStorm.
 * User: Matteo Scirea
 * Date: 29/10/2020
 * Time: 16:17
 */

//Richiamo api Musement
require_once 'Controllers/Libraries/Definitions/CostantiJagaad.php';
require_once 'Controllers/Libraries/UtilizzoApi.php';
$usedApi = new \Controlles\Libraries\UtilizzoApi();
list($esito, $muList) = $usedApi->getMusementCityList();
if($muList != \Controllers\Libraries\Definitions\CostantiJagaad::SUCCESS) {

    foreach ($muList as $item) {

        list($esito, $weather) = $usedApi->getWeatherCity($item);
        if($esito == \Controllers\Libraries\Definitions\CostantiJagaad::SUCCESS) {

            $string = $item->city .' | '. $weather->forecast->forecastday[0]->day->condition->text .' - ' . $weather->forecast->forecastday[1]->day->condition->text;
            echo $string;

        } else {

            echo $esito;

        }

    }

} else {

    echo $esito;

}

?>
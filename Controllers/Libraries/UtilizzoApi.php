<?php
/**
 * Created by PhpStorm.
 * User: Matteo Scirea
 * Date: 29/10/2020
 * Time: 16:19
 */

namespace Controlles\Libraries;


use Controllers\Libraries\Definitions\CostantiJagaad;

class UtilizzoApi {

    /**
     * UtilizzoApi constructor.
     */
    public function __construct() {

    }

    /**
     * @return array
     */
    public function getMusementCityList() {

        $valore = null;

        try {

            $curl = curl_init();
            $url = 'https://api.musement.com/api/v3/cities';

            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
            $result = curl_exec($curl);

            if (!curl_errno($curl)) {

                $esito  = CostantiJagaad::SUCCESS;
                $valore = json_decode($result);

            } else {

                $esito = CostantiJagaad::CURL_MUSEMENT_ERROR;

            }

            curl_close($curl);

        } catch (\Exception $e) {

            $valore = 'Caught exception: ' . $e->getMessage();
            $esito  = CostantiJagaad::CURL_MUSEMENT_EXCEPTION;

        }

        unset($url, $curl);
        return array($esito, $valore);

    }

    /**
     * @param $city
     * @return array
     */
    public function getWeatherCity($city) {

        try{

            $curl = curl_init();
            $url = ' http://api.weatherapi.com/v1/forecast.json?key=' . CostantiJagaad::WEATHER_API_KEY . '&q=' . $city->latitude . ',' . $city->longitude . '&days=2';

            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            $result = curl_exec($curl);

            // Check the return value of curl_exec(), too
            if ($result === false) {
                throw new \Exception(curl_error($curl), curl_errno($curl));
            }

            if (!curl_errno($curl)) {

                $esito  = CostantiJagaad::SUCCESS;
                $valore = json_decode($result);

            } else {

                $esito = CostantiJagaad::CURL_MUSEMENT_ERROR;

            }

            curl_close($curl);

        } catch (\Exception $e) {

            $valore = 'Caught exception: ' . $e->getMessage();

        }

        unset($url, $curl);
        return array($esito, $valore);

    }

}
<?php 


Class Covid
{
public $url = "https://api.apify.com/v2/key-value-stores/qAEsnylzdjhCCyZeS/records/LATEST?disableRedirect=true";

    public function total_infected()
    {
        $data = file_get_contents($this->url); 
        $data_to_array = json_decode($data); 

        $infikovaných = 0;
        foreach ($data_to_array->data as $all_time) {

            foreach ($all_time as $every_day) {
                $infikovaných++;
            }

        }
        return $infikovaných;
    }

    public function pohlavi_infikovanych()
    {
        $switcher = true;

        $data = file_get_contents($this->url); // získá nám obsah API
        $data_to_array = json_decode($data); // dekoduje javascript, abychom s ním mohli pracovat v PHP


        $pohlavi_infikovanych = 0;

        foreach ($data_to_array->data as $all_time) {

            foreach ($all_time as $every_day) {

                if ($every_day[1] == "muž" && $switcher == true) {

                    $pohlavi_infikovanych++; 

                } elseif ($every_day[1] == "žena" && $switcher == false) {

                    $pohlavi_infikovanych++;

                }

            }

        }

        if ($switcher == true) {
            return $pohlavi_infikovanych . " mužů";
        } elseif ($switcher == false) {
            return $pohlavi_infikovanych . " žen";
        }

    }

    public function average_age()
    {
        $data = file_get_contents($this->url); // získá nám obsah api
        $data_to_array = json_decode($data); // dekoduje javascript, abychom s ním mohli pracovat v PHP
        
        $average_age = array();

        foreach ($data_to_array->data as $all_time) {
            foreach ($all_time as $every_day) {
                $average_age[] .= $every_day[0] . ", ";
            }
        }
        
        return round(array_sum($average_age) / count($average_age));
    }

}

?>
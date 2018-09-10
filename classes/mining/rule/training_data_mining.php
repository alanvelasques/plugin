<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tecmides\mining\rule;

require_once(__DIR__ . "/base_rule_mining_step.php");
require_once(__DIR__ . "/../../minerator/minerator.php");

/**
 * Description of training_data_mining
 *
 * @author alan
 */
class training_data_mining extends base_rule_mining_step {

    public function generate_training_data(){
        global $CFG;

        $dataToMining = $this->get_mining_data();

        $url = $CFG->TecmidesWebserviceURL.'/rule_model/contribute';

        $content = json_encode($dataToMining);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        echo("Call to URL $url returned with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));

        curl_close($curl);

        $response = json_decode($json_response, true);

        print_r($response);

        return $dataToMining;
    }

    protected function get_class_attribute() {
        return "";
    }

}

<?php

namespace tecmides\minerator;

require_once(__DIR__ . "/minerator.php");
require_once(__DIR__ . "/../mining/rule/domain/rule.php");
require_once(__DIR__ . "/../mining/rule/domain/operand.php");

class tecmideswebservice_minerator implements minerator
{

    private $client;

    public function __construct()
    {
        global $CFG;
        $this->client = new \SoapClient(
            $CFG->TecmidesWebserviceURL,
            array(
                "style" => SOAP_DOCUMENT,
                "use" => SOAP_LITERAL,
                "classmap" => array(
                    "operand" => 'tecmides\mining\rule\domain\operand',
                    "rule" => 'tecmides\mining\rule\domain\rule'
                )
            )
        );

    }

    public function generate_rules_by_attr_relativity( $data, $header, $idxClassAttr, $numRules, $minSupport, $minConfidence )
    {
        $arffString = $this->generate_arff($data, $header);

        $parameters = array(
            "arg0" => $arffString,
            "arg1" => $idxClassAttr,
            "arg2" => $numRules,
            "arg3" => $minSupport,
            "arg4" => $minConfidence
        );

        $response = $this->client->generateRulesByAttrRelativity($parameters);
        $rules = property_exists($response, "return") ? $response->return : array();

        if(!is_array($rules)) {
            $rules = [$rules];
        }

        return $this->normalize_response($rules);

    }

    public function generate_rules( $data, $header, $numRules, $minSupport, $minConfidence )
    {
        $arffString = $this->generate_arff($data, $header);

        $parameters = array(
            "arg0" => $arffString,
            "arg1" => $numRules,
            "arg2" => $minSupport,
            "arg3" => $minConfidence
        );

        $response = $this->client->generateRules($parameters);

        $rules = property_exists($response, "return") ? $response->return : array();

        if(!is_array($rules)) {
            $rules = [$rules];
        }

        return $this->normalize_response($rules);

    }

    private function generate_arff( $data, $header )
    {
        $strHeader = "@RELATION tecmides\n";

        foreach ( $header as $key => $item )
        {
            $strHeader .= "@ATTRIBUTE {$key} {" . implode(",", $item) . "}\n";
        }

        $strData = "@DATA\n";

        foreach ( $data as $item )
        {
            $info = [];

            foreach ( array_keys($header) as $column )
            {
                $info[] = $item->$column;
    }

            // Substitui o '-' por '?'
            $strData .= str_replace("-", "?", implode(",", $info)) . "\n";
        }

        return $strHeader . $strData;

    }

    private function normalize_response( $rules )
    {
        foreach ( $rules as $key => $rule )
        {
            if ( ! is_array($rule->antecedent) )
            {
                $rules[$key]->antecedent = array( $rule->antecedent );
            }

            if ( ! is_array($rule->consequent) )
            {
                $rules[$key]->consequent = array( $rule->consequent );
            }
        }

        return $rules;

    }

}

<?php


namespace MathExpressionBuilder;


class Balance extends Money {


    private $line;


    public function __construct($value, $name, $currency, $line) {
        parent::__construct($value, $name, $currency);
        $this->line = $line;
    }



    /**
     * @return mixed
     */
    public function getName() {
        return "{$this->name} #{$this->line}";
    }



}
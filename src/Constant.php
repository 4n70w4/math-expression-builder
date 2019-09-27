<?php


namespace MathExpressionBuilder;


class Constant implements Expressionable {


    private $value;



    public function __construct($value) {
        $this->value = $value;
    }



    public function calc() {
        return $this->value;
    }



}
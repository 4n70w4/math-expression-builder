<?php


namespace MathExpressionBuilder\Comparisons;


use MathExpressionBuilder\Expressionable;

abstract class Comparison implements Expressionable {

    /**
     * @var Expressionable
     */
    protected $value;



    public function __construct(Expressionable $value) {
        $this->value = $value;
    }



    public function calc() {
        return;
    }



    abstract public function compare(Expressionable $value);

    abstract public function getSign();



    /**
     * @return Expressionable
     */
    public function getValue() : Expressionable {
        return $this->value;
    }


}
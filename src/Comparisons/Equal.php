<?php


namespace MathExpressionBuilder\Comparisons;


use MathExpressionBuilder\Expressionable;

class Equal extends Comparison {



    public function compare(Expressionable $value) {
        $comp = bccomp($value->calc(), $this->value->calc());

        return 0 === $comp;
    }



    public function getSign() {
        return '=';
    }



}
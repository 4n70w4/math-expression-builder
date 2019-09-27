<?php


namespace MathExpressionBuilder\Operators;


class DivisionByZero extends Division {



    public function operator($left, $right) {
        if(0 === bccomp($right, 0) ) {
            return 0;
        }

        return parent::operator($left, $right);
    }



    public function getSign() {
        return '/';
    }



}
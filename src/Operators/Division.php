<?php


namespace MathExpressionBuilder\Operators;


class Division extends Operator {



    public function operator($left, $right) {
        return bcdiv($left, $right);
    }



    public function getSign() {
        return '/';
    }



}
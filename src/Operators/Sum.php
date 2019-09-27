<?php


namespace MathExpressionBuilder\Operators;


class Sum extends Operator {



    public function operator($left, $right) {
        return bcadd($left, $right);
    }



    public function getSign() {
        return '+';
    }



}
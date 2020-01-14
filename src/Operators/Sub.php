<?php

namespace MathExpressionBuilder\Operators;

class Sub extends Sum
{
    public function operator($left, $right)
    {
        return bcsub($left, $right);
    }

    public function getSign()
    {
        return '-';
    }
}

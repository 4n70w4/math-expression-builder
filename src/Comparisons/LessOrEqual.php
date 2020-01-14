<?php

namespace MathExpressionBuilder\Comparisons;

use MathExpressionBuilder\Expressionable;

class LessOrEqual extends Comparison
{
    public function compare(Expressionable $value)
    {
        $comp = bccomp($value->calc(), $this->value->calc());

        return -1 === $comp || 0 === $comp;
    }

    public function getSign()
    {
        return '<=';
    }
}

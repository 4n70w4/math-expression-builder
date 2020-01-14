<?php

namespace MathExpressionBuilder;

class Coefficient implements Expressionable
{
    private $coef;

    /**
     * @var Expressionable
     */
    private $expression;

    public function __construct($coef, Expressionable $expression)
    {
        $this->coef = $coef;
        $this->expression = $expression;
    }

    public function calc()
    {
        $calc = $this->expression->calc();

        if (is_nan($calc)) {
            return 0;
        }

        return bcmul($this->coef, $calc);
    }

    /**
     * @return mixed
     */
    public function getCoef()
    {
        return $this->coef;
    }

    /**
     * @return Expressionable
     */
    public function getExpression(): Expressionable
    {
        return $this->expression;
    }
}

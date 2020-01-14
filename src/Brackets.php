<?php

namespace MathExpressionBuilder;

class Brackets implements Expressionable
{
    /**
     * @var Expressionable
     */
    protected $expression;

    public function __construct(Expressionable $expression)
    {
        $this->expression = $expression;
    }

    public function calc()
    {
        return $this->expression->calc();
    }

    /**
     * @return Expressionable
     */
    public function getExpression(): Expressionable
    {
        return $this->expression;
    }
}

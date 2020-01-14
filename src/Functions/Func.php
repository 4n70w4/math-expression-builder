<?php

namespace MathExpressionBuilder\Functions;

use MathExpressionBuilder\Expressionable;

abstract class Func implements Expressionable
{
    /**
     * @var Expressionable
     */
    private $expression;

    private $arguments;

    public function __construct(Expressionable $expression, ...$arguments)
    {
        $this->expression = $expression;
        $this->arguments = $arguments;
    }

    public function calc()
    {
        $calc = $this->computation($this->expression->calc(), ...$this->arguments);

        if (is_nan($calc)) {
            return 0;
        }

        return $calc;
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return Expressionable
     */
    public function getExpression(): Expressionable
    {
        return $this->expression;
    }

    abstract public function computation($value);

    abstract public function getName();
}

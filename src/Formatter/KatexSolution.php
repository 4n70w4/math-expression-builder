<?php

namespace MathExpressionBuilder\Formatter;

use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Division;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Value;

class KatexSolution extends TextSolution
{
    /**
     * @param Value $expression
     *
     * @return string
     */
    protected function value(Value $expression)
    {
        return str_replace([' ', '#'], ['\ ', '\#'], parent::value($expression));
    }

    /**
     * @param Expression $expression
     *
     * @return string
     */
    protected function expression(Expression $expression)
    {
        if ($this->depth > 0) {
            // str_replace(' ', '\ ', parent::value($expression) );
            return $expression->calc();
        }

        return "{$expression->getName()} = {$this->format($expression->getExpression())}";
    }

    /**
     * @param Operator $expression
     *
     * @return string
     */
    protected function operator(Operator $expression)
    {
        if ($expression instanceof Division) {
            return $this->division($expression->getExpressions());
        }

        return parent::operator($expression);
    }

    protected function division($expressions)
    {
        $buffer = $this->format(array_shift($expressions));

        if (count($expressions) === 0) {
            return $buffer;
        }

        $buffer = "{{$buffer} \over {$this->division($expressions)}}";

        return $buffer;
    }

    /**
     * @param Brackets $expression
     *
     * @return string
     */
    protected function brackets(Brackets $expression)
    {
        return parent::brackets($expression);
    }

    /**
     * @param Coefficient $expression
     *
     * @return string
     */
    protected function coefficient(Coefficient $expression)
    {
        return parent::coefficient($expression);
    }

    /**
     * @param Func $expression
     *
     * @return string
     */
    protected function func(Func $expression)
    {
        $args = implode(', ', $expression->getArguments());

        return "\\{$expression->getName()}{".$this->format($expression->getExpression()).($args ? ', '.$args : '').'}';
    }
}

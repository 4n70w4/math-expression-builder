<?php


namespace MathExpressionBuilder\Formatter;


use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Constant;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Division;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Value;

class Json extends Formatter {



    /**
     * @param Value $expression
     *
     * @return array
     */
    protected function value(Value $expression) : array {
        return ['value' => $expression->calc(), 'name' => $expression->getName()];
    }



    /**
     * @param Expression $expression
     *
     * @return array
     */
    protected function expression(Expression $expression) : array {
        return ['name' => $expression->getName(), 'expression' => $this->format($expression->getExpression())];
    }



    /**
     * @param Operator $expression
     *
     * @return array
     */
    protected function operator(Operator $expression) : array {
        $buffer = [];

        foreach ($expression->getExpressions() as $expr) {
            $buffer[] = $this->format($expr);
        }

        return ['sum' => $buffer];
    }



    /**
     * @param Brackets $expression
     *
     * @return array
     */
    protected function brackets(Brackets $expression) : array {
        return ['brackets' => $this->format($expression->getExpression())];
    }



    /**
     * @param Coefficient $expression
     *
     * @return array
     */
    protected function coefficient(Coefficient $expression) : array {
        return ['сoefficient' => $expression->getCoef(), 'expression' => $this->format($expression->getExpression())];
    }



    /**
     * @param Division $expression
     *
     * @return array
     */
    protected function division(Division $expression) : array {
        $buffer = [];

        foreach ($expression->getExpressions() as $expr) {
            $buffer[] = $this->format($expr->getExpression());
        }

        return ['division' => $buffer];
    }



    /**
     * @param Func $expression
     *
     * @return array
     */
    protected function func(Func $expression) {
        return [
            'function' => $expression->getName(),
            'arguments' => $expression->getArguments(),
            'expression' => $this->format($expression->getExpression())
        ];
    }



    protected function constant(Constant $expression) {
        return ['constant' => $expression->calc()];
    }



}
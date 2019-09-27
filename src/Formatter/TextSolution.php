<?php


namespace MathExpressionBuilder\Formatter;


use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Constant;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Value;

class TextSolution extends TextEquation {



    /**
     * @param Value $expression
     *
     * @return string
     */
    protected function value(Value $expression) {
        return $expression->getValue();
    }



    /**
     * @param Constant $expression
     *
     * @return string
     */
    protected function constant(Constant $expression) {
        return parent::constant($expression);
    }



    /**
     * @param Expression $expression
     *
     * @return string
     */
    protected function expression(Expression $expression) {
        if($this->depth > 0) {
            return str_replace(' ', '\ ', $expression->calc() );
        }

        return "{$expression->getName()} = {$this->format($expression->getExpression())}";
    }



    /**
     * @param Operator $expression
     *
     * @return string
     */
    protected function operator(Operator $expression) {
       return parent::operator($expression);
    }



    /**
     * @param Brackets $expression
     *
     * @return string
     */
    protected function brackets(Brackets $expression) {
        return parent::brackets($expression);
    }



    /**
     * @param Coefficient $expression
     *
     * @return string
     */
    protected function coefficient(Coefficient $expression) {
        return parent::coefficient($expression);
    }



    /**
     * @param Func $expression
     *
     * @return string
     */
    protected function func(Func $expression) {
        return parent::func($expression);
    }



}
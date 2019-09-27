<?php


namespace MathExpressionBuilder\Formatter;

use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Comparisons\Comparison;
use MathExpressionBuilder\Constant;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Expressionable;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Scoring;
use MathExpressionBuilder\Value;

abstract class Formatter {

    /**
     * @var int
     */
    protected $depth = 0;



    abstract protected function value(Value $expression);
    abstract protected function constant(Constant $expression);
    abstract protected function expression(Expression $expression);
    abstract protected function operator(Operator $expression);
    abstract protected function brackets(Brackets $expression);
    abstract protected function coefficient(Coefficient $expression);
    abstract protected function func(Func $expression);
    // abstract protected function scoring(Scoring $expression);



    /**
     * @param Func $expression
     */
    protected function scoring(Scoring $expression) {
        return $this->format($expression->getExpression());
    }



    private function comparison(Comparison $expression) {
        return $expression->getValue();
    }



    public function format(Expressionable $expression, $depth = null) {

        if($depth) {
            $this->depth = $depth;
        }

        if($expression instanceof Value) {
            return $this->value($expression);
        }

        if($expression instanceof Constant) {
            return $this->constant($expression);
        }

        if($expression instanceof Expression) {
            return $this->expression($expression);
        }

        if($expression instanceof Operator) {
            return $this->operator($expression);
        }

        if($expression instanceof Brackets) {
            return $this->brackets($expression);
        }

        if($expression instanceof Coefficient) {
            return $this->coefficient($expression);
        }

        if($expression instanceof Func) {
            return $this->func($expression);
        }

        if($expression instanceof Scoring) {
            return $this->scoring($expression);
        }

        if($expression instanceof Comparison) {
            return $this->comparison($expression);
        }

        return null;
    }


}
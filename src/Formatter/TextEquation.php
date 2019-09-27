<?php


namespace MathExpressionBuilder\Formatter;


use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Constant;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Value;

class TextEquation extends Formatter {



    /**
     * @param Value $expression
     *
     * @return string
     */
    protected function value(Value $expression) {
        return $expression->getName();
    }



    /**
     * @param Constant $expression
     *
     * @return string
     */
    protected function constant(Constant $expression) {
        return $expression->calc();
    }



    /**
     * @param Expression $expression
     *
     * @return string
     */
    protected function expression(Expression $expression) {
        if($this->depth > 0) {
            return $expression->getName();
        }

        return "{$expression->getName()} = {$this->format($expression->getExpression())}";
    }



    /**
     * @param Operator $expression
     *
     * @return string
     */
    protected function operator(Operator $expression) {
        $buffer = [];

        foreach($expression->getExpressions() as $expr) {
            $buffer[] = $this->format($expr);
        }

        return implode(" {$expression->getSign()} ", $buffer);
    }



    /**
     * @param Brackets $expression
     *
     * @return string
     */
    protected function brackets(Brackets $expression) {
        return "({$this->format($expression->getExpression())})";
    }



    /**
     * @param Coefficient $expression
     *
     * @return string
     */
    protected function coefficient(Coefficient $expression) {
        return $expression->getCoef() . ' × ' . $this->format($expression->getExpression());
    }



    /**
     * @param Func $expression
     *
     * @return string
     */
    protected function func(Func $expression) {
        $args = implode(', ', $expression->getArguments() );
        return "{$expression->getName()}({$this->format($expression->getExpression())}" . ($args ? ', ' . $args : '') . ')';
    }



}
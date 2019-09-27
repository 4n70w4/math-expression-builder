<?php


namespace MathExpressionBuilder\Formatter;


use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Comparisons\Comparison;
use MathExpressionBuilder\Constant;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Scoring;
use MathExpressionBuilder\Value;

class Scorer extends Formatter {


    /**
     * @var Formatter
     */
    private $Equation;

    /**
     * @var Formatter
     */
    private $Solution;



    public function __construct(Formatter $Equation, Formatter $Solution) {
        $this->Equation = $Equation;
        $this->Solution = $Solution;
    }



    /**
     * @param Func $expression
     */
    protected function scoring(Scoring $expression) {
        $buffer = [];

        /**
         * @var Comparison $comparison
         */
        foreach($expression->getComparisons() as $i => [$comparison, $result]) {
            $buffer[] = [
                'compare' => $comparison->getSign(),
                'value' => $comparison->getValue()->calc(),
                'result' => $result,
            ];
        }

        return $buffer;
    }



    /**
     * @param Value $expression
     *
     * @return string
     */
    protected function value(Value $expression) {
        return null;
    }



    /**
     * @param Expression $expression
     *
     * @return string
     */
    protected function expression(Expression $expression) {
        return null;
    }



    /**
     * @param Operator $expression
     *
     * @return string
     */
    protected function operator(Operator $expression) {
        return null;
    }



    /**
     * @param Brackets $expression
     *
     * @return string
     */
    protected function brackets(Brackets $expression) {
        return null;
    }



    /**
     * @param Coefficient $expression
     *
     * @return string
     */
    protected function coefficient(Coefficient $expression) {
        return null;
    }



    /**
     * @param Func $expression
     *
     * @return string
     */
    protected function func(Func $expression) {
        return null;
    }



    /**
     * @param Constant $expression
     */
    protected function constant(Constant $expression) {
        return null;
    }



}
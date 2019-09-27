<?php


namespace MathExpressionBuilder;


use MathExpressionBuilder\Comparisons\Comparison;

class Scoring implements Expressionable {


    /**
     * @var Expressionable
     */
    protected $expression;

    protected $comparisons = [];



    public function __construct(Expressionable $expression) {
        $this->expression = $expression;
    }



    public function add(Comparison $comparison, $result) {
        $this->comparisons[] = [$comparison, $result];
    }



    public function calc() {
        return $this->expression->calc();
    }



    public function score() {
        /**
         * @var Comparison $comparison
         */
        foreach($this->comparisons as $k => [$comparison, $result]) {
            if($comparison->compare($this->expression) ) {
                return $result;
            }
        }

    }



    /**
     * @return Expressionable
     */
    public function getExpression(): Expressionable {
        return $this->expression;
    }



    /**
     * @return array
     */
    public function getComparisons() : array {
        return $this->comparisons;
    }


}
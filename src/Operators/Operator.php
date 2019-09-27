<?php


namespace MathExpressionBuilder\Operators;


use MathExpressionBuilder\Expressionable;

abstract class Operator implements Expressionable {


    /**
     * @var Expressionable[]
     */
    protected $expressions;



    public function __construct(Expressionable...$expressions) {
        $this->expressions = $expressions;
    }



    public function calc() {
        reset($this->expressions);

        $buffer = $this->expressions[0]->calc();

        while(next( $this->expressions) !== false)  {
            $buffer = $this->operator($buffer, current($this->expressions)->calc() );
        }

        return $buffer;
    }



    /**
     * @return Expressionable[]
     */
    public function getExpressions() : array {
        return $this->expressions;
    }



    abstract public function getSign();

    abstract public function operator($left, $right);



}
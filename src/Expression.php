<?php


namespace MathExpressionBuilder;


class Expression implements Expressionable {


    /**
     * @var Expressionable
     */
    protected $expression;
    protected $name;
    private $description;



    public function __construct(Expressionable $expression, $name, $description = null) {
        $this->expression = $expression;
        $this->name = $name;
        $this->description = $description;
    }



    public function calc() {
        return $this->expression->calc();
    }



    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }



    /**
     * @return Expressionable
     */
    public function getExpression() : Expressionable {
        return $this->expression;
    }



    /**
     * @return null
     */
    public function getDescription() {
        return $this->description;
    }


}
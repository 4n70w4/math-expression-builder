<?php


namespace MathExpressionBuilder\Formatter;


use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Coefficient;
use MathExpressionBuilder\Constant;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Functions\Func;
use MathExpressionBuilder\Operators\Operator;
use MathExpressionBuilder\Value;

class Expressions extends Formatter {


    /**
     * @var Formatter
     */
    private $Equation;

    /**
     * @var Formatter
     */
    private $Solution;

    /**
     * @var Formatter
     */
    private $Full;



    public function __construct(Formatter $Equation, Formatter $Solution, Formatter $Full) {
        $this->Equation = $Equation;
        $this->Solution = $Solution;
        $this->Full = $Full;
    }



    /**
     * @param Value $expression
     */
    protected function value(Value $expression) {
        return null;
    }



    /**
     * @param Constant $expression
     */
    protected function constant(Constant $expression) {
        return null;
    }



    /**
     * @param Expression $expression
     */
    protected function expression(Expression $expression) {
        return (object) [
            'name' => $expression->getName(),
            'description' => $expression->getDescription(),
            'result' => $expression->calc(),
            'equation' => $this->Equation->format($expression),
            'solution' => $this->Solution->format($expression),
            'full' => $this->Full->format($expression),
        ];
    }



    /**
     * @param Operator $expression
     */
    protected function operator(Operator $expression) {
         $buffer = [];

        foreach($expression->getExpressions() as $expr) {
            if($expr instanceof Value || $expr instanceof Constant) {
                continue;
            }

            $data = $this->format($expr);

            if(is_array($data) ) {
                $buffer = array_merge($buffer, $data);
            } else {
                $buffer[] = $data;
            }

        }

        return $buffer;
    }



    /**
     * @param Brackets $expression
     */
    protected function brackets(Brackets $expression) {
        return $this->format($expression->getExpression());
    }



    /**
     * @param Coefficient $expression
     */
    protected function coefficient(Coefficient $expression) {
        return $this->format($expression->getExpression());
    }



    /**
     * @param Func $expression
     */
    protected function func(Func $expression) {
        return $this->format($expression->getExpression());
    }



}
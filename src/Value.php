<?php


namespace MathExpressionBuilder;


class Value implements Expressionable {


    protected $value;
    protected $name;



    public function __construct($value, $name) {
        $this->value = $value;
        $this->name = $name;
    }



    public function calc() {
        return $this->value;
    }



    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
        return number_format($this->value, 2, ',', ' ');
    }



    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }


}
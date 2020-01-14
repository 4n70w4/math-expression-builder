<?php

namespace MathExpressionBuilder;

class Money extends Value
{
    protected $currency;

    public function __construct($value, $name, $currency)
    {
        parent::__construct($value, $name);

        $this->currency = $currency;
    }

    public function calc()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return number_format($this->value, 2, ',', ' ').' '.$this->currency;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}

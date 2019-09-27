<?php


namespace MathExpressionBuilder\Functions;


class Log extends Func {



    public function computation($value, $base = 10) {
        return bcadd(log($value, $base), 0);
    }



    public function getName() {
        return 'log';
    }


}
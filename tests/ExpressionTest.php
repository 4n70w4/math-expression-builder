<?php

namespace App\Services\BankruptcyCalculatorService\Tests;

use MathExpressionBuilder\Brackets;
use MathExpressionBuilder\Expression;
use MathExpressionBuilder\Formatter\Json;
use MathExpressionBuilder\Formatter\TextEquation;
use MathExpressionBuilder\Formatter\TextSolution;
use MathExpressionBuilder\Operators\Sum;
use MathExpressionBuilder\Value;
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{
    public function testValue()
    {
        $a = new Value(12, 'A');

        $result = $a->calc();
        $this->assertEquals(12, $result);

        $json = new Json();

        $result = $json->format($a);
        $this->assertEquals(['value' => 12, 'name' => 'A'], $result);

        $text = new TextEquation();

        $result = $text->format($a);
        $this->assertEquals('A', $result);

        $text = new TextSolution();

        $result = $text->format($a);
        $this->assertEquals('12', $result);

        /*        $katex = new Katex();
        
                $result = $katex->equation($a);
                $this->assertEquals( 'A', $result);
        
                $result = $katex->solution($a);
                $this->assertEquals( '12', $result);*/
    }

    public function testExpression()
    {
        $a = new Value(12, 'A');
        $x = new Expression($a, 'X');

        $result = $x->calc();
        $this->assertEquals(12, $result);

        $json = new Json();

        $result = $json->format($x);
        $this->assertEquals(['name' => 'X', 'expression' => ['value' => 12, 'name' => 'A']], $result);

        $text = new TextEquation();

        $result = $text->format($x);
        $this->assertEquals('X = A', $result);

        $text = new TextSolution();

        $result = $text->format($x);
        $this->assertEquals('X = 12', $result);

        /*        $katex = new Katex();
        
                $result = $katex->equation($x);
                $this->assertEquals('X = A', $result);
        
                $result = $katex->solution($x);
                $this->assertEquals('X = 12', $result);*/
    }

    public function testNestedExpression()
    {
        $a = new Value(12, 'A');

        $x = new Expression($a, 'X');
        $y = new Expression($x, 'Y');

        $result = $y->calc();
        $this->assertEquals(12, $result);

        $json = new Json();

        $result = $json->format($y);
        $this->assertEquals(['name' => 'Y', 'expression' => ['name' => 'X', 'expression' => ['value' => 12, 'name' => 'A']]], $result);

        $text = new TextEquation();

        $result = $text->format($y);
        $this->assertEquals('Y = X = A', $result);

        $text = new TextSolution();

        $result = $text->format($y);
        $this->assertEquals('Y = X = 12', $result);

        /*        $katex = new Katex();
        
                $result = $katex->equation($y);
                $this->assertEquals('Y = X = A', $result);
        
                $result = $katex->solution($y);
                $this->assertEquals('Y = X = 12', $result);*/
    }

    public function testSum()
    {
        $a = new Value(12, 'A');
        $b = new Value(3, 'B');

        $t1 = new Sum($a, $b);

        $result = $t1->calc();
        $this->assertEquals(15, $result);

        $json = new Json();

        $result = $json->format($t1);

        $expected = [
            'sum' => [
                ['value' => 12, 'name' => 'A'],
                ['value' => 3, 'name' => 'B'],
            ],
        ];

        $this->assertEquals($expected, $result);

        $text = new TextEquation();

        $result = $text->format($t1);
        $this->assertEquals('A + B', $result);

        $text = new TextSolution();

        $result = $text->format($t1);
        $this->assertEquals('12 + 3', $result);

        /*        $katex = new Text();
        
                $result = $katex->equation($t1);
                $this->assertEquals('A + B', $result);
        
                $result = $katex->solution($t1);
                $this->assertEquals('12 + 3', $result);*/
    }

    public function testNestedSum()
    {
        $a = new Value(12, 'A');
        $b = new Value(3, 'B');
        $c = new Value(5, 'C');

        $t1 = new Sum($a, $b);
        $y = new Sum($t1, $c);

        $result = $y->calc();
        $this->assertEquals(20, $result);

        $json = new Json();

        $result = $json->format($y);

        $expected = [
            'sum' => [
                [
                    'sum' => [
                        ['value' => 12, 'name' => 'A'],
                        ['value' => 3, 'name' => 'B'],
                    ],
                ],
                ['value' => 5, 'name' => 'C'],
            ],
        ];

        $this->assertEquals($expected, $result);

        $text = new TextEquation();

        $result = $text->format($y);
        $this->assertEquals('A + B + C', $result);

        $text = new TextSolution();

        $result = $text->format($y);
        $this->assertEquals('12 + 3 + 5', $result);

        /*        $katex = new Text();
        
                $result = $katex->equation($y);
                $this->assertEquals('A + B + C', $result);
        
                $result = $katex->solution($y);
                $this->assertEquals('12 + 3 + 5', $result);*/
    }

    public function testBrackets()
    {
        $a = new Value(12, 'A');
        $b = new Value(3, 'B');
        $c = new Value(5, 'C');

        $brackers = new Brackets(
            new Sum($b, $c)
        );

        $t1 = new Sum($a, $brackers);

        $result = $t1->calc();
        $this->assertEquals(20, $result);

        $json = new Json();

        $result = $json->format($t1);

        $expected = [
            'sum' => [
                ['value' => 12, 'name' => 'A'],
                ['brackets' => [
                    'sum' => [
                        ['value' => 3, 'name' => 'B'],
                        ['value' => 5, 'name' => 'C'],
                    ],
                ],
                ],
            ],
        ];

        $this->assertEquals($expected, $result);

        $text = new TextEquation();

        $result = $text->format($t1);
        $this->assertEquals('A + (B + C)', $result);

        $text = new TextSolution();

        $result = $text->format($t1);
        $this->assertEquals('12 + (3 + 5)', $result);

        /*        $katex = new Text();
        
                $result = $katex->equation($t1);
                $this->assertEquals('A + (B + C)', $result);
        
                $result = $katex->solution($t1);
                $this->assertEquals('12 + (3 + 5)', $result);*/
    }
}

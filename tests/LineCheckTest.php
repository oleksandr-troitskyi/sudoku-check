<?php

namespace Tests;

use SudokuCheck\Checks\Link;
use SudokuCheck\Checks\Check;
use PHPUnit\Framework\TestCase;
use SudokuCheck\Checks\LinesCheck;

class LineCheckTest extends TestCase
{
    public function testItImplementsCheckInterface()
    {
        $check = new LinesCheck();
        $this->assertInstanceOf(Check::class, $check);
        $this->assertInstanceOf(Link::class, $check);
    }

    public function testItFailsWhenDuplicatedNumberFoundOnLine()
    {
        $check = new LinesCheck();

        $expected = [
            'duplicated value at line 5'
        ];
        $board = [
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 5, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 5, 6, 7, 8, 9]
        ];
        $this->assertEquals($expected, $check->check($board));
    }

    public function testItPassesLinesCheck()
    {
        $check = new LinesCheck();
        $board = [
            [1, 8, 2, 5, 4, 3, 6, 9, 7],
            [9, 6, 5, 1, 7, 8, 3, 4, 2],
            [7, 4, 3, 9, 6, 2, 8, 1, 5],
            [3, 7, 4, 8, 9, 6, 5, 2, 1],
            [6, 2, 8, 4, 5, 1, 7, 3, 9],
            [5, 1, 9, 2, 3, 7, 4, 6, 8],
            [2, 9, 7, 6, 8, 4, 1, 5, 3],
            [4, 3, 1, 7, 2, 5, 9, 8, 6],
            [8, 5, 6, 3, 1, 9, 2, 7, 4]
        ];
        $this->assertEquals([], $check->check($board));
    }
}
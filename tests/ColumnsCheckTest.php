<?php

namespace Tests;

use SudokuCheck\Checks\Link;
use SudokuCheck\Checks\Check;
use PHPUnit\Framework\TestCase;
use SudokuCheck\Checks\ColumnsCheck;

class ColumnsCheckTest extends TestCase
{
    public function testItImplementsCheckInterface()
    {
        $check = new ColumnsCheck();
        $this->assertInstanceOf(Check::class, $check);
        $this->assertInstanceOf(Link::class, $check);
    }

    public function testItFailsWithDuplicatedNumberFoundInColumn()
    {
        $check = new ColumnsCheck();
        $expected = [
            'duplicated value at column 3',
            'duplicated value at column 8'
        ];
        $board = [
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            [2, 3, 4, 5, 6, 7, 8, 9, 1],
            [3, 4, 5, 6, 7, 8, 9, 1, 2],
            [4, 5, 6, 7, 8, 9, 1, 2, 3],
            [5, 6, 3, 8, 9, 1, 2, 7, 4],
            [6, 7, 8, 9, 1, 2, 3, 4, 5],
            [7, 8, 9, 1, 2, 3, 4, 5, 6],
            [8, 9, 1, 2, 3, 4, 5, 6, 7],
            [9, 1, 2, 3, 4, 5, 6, 7, 8]
        ];
        $this->assertEquals($expected, $check->check($board));
    }

    public function testItPassesColumnsCheck()
    {
        $check = new ColumnsCheck();
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

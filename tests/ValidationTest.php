<?php

namespace Tests;

use SudokuCheck\Checks\Link;
use SudokuCheck\Checks\Check;
use PHPUnit\Framework\TestCase;
use SudokuCheck\Checks\Validation;

class ValidationTest extends TestCase
{
    public function testItImplementsCheckInterface()
    {
        $check = new Validation();
        $this->assertInstanceOf(Check::class, $check);
        $this->assertInstanceOf(Link::class, $check);
    }

    public function testCheckEmptyInput()
    {
        $check = new Validation();
        $expected = [
            'empty board'
        ];

        $this->assertEquals($expected, $check->check([]));
    }

    public function testCheckBoardContainsLessLinesThanNeeded()
    {
        $check = new Validation();
        $expected = ['not enough lines'];
        $board = [
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            []
        ];

        $this->assertEquals(
            $expected,
            $check->check(
                $board
            )
        );
    }

    public function testCheckLinesContainsNotEnoughColumns()
    {
        $check = new Validation();
        $expected = [
            'line 5 have 8 cells, but should have 9'
        ];
        $board = [
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1]
        ];

        $this->assertEquals($expected, $check->check($board));

        $expected = [
            'line 3 have 7 cells, but should have 9',
            'line 5 have 8 cells, but should have 9'
        ];
        $board = [
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1]
        ];

        $this->assertEquals($expected, $check->check($board));
    }

    public function testItChecksIfEveryLineFilledWithInt()
    {
        $check = new Validation();
        $expected = [
            'line 5 cell 7 should have integer value'
        ];
        $board = [
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 'test', 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1]
        ];

        $this->assertEquals($expected, $check->check($board));

        $expected = [
            'line 3 cell 6 should have integer value',
            'line 5 cell 7 should have integer value'
        ];
        $board = [
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, null, 7, 4, 2],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 34.5, 2, 10],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1],
            [7, 4, 4, 5, 2, 6, 7, 2, 1]
        ];

        $this->assertEquals($expected, $check->check($board));
    }

    public function testItPassesValidation()
    {
        $check = new Validation();
        $board = [
            [1, 8, 2, 5, 4, 3, 6, 9, 7],
            [9, 6, 5, 1, 7, 8, 3, 4, 2],
            [7, 4, 6, 9, 3, 2, 8, 1, 5],
            [3, 7, 4, 8, 9, 6, 5, 2, 1],
            [6, 2, 8, 4, 5, 1, 7, 3, 9],
            [5, 1, 9, 2, 3, 7, 4, 6, 8],
            [2, 9, 7, 3, 8, 4, 1, 5, 6],
            [4, 6, 1, 7, 2, 5, 9, 8, 3],
            [8, 5, 3, 6, 1, 9, 2, 7, 4]
        ];
        $this->assertEquals([], $check->check($board));
    }
}

<?php

namespace Tests;

use SudokuCheck\SudokuCheck;
use PHPUnit\Framework\TestCase;

class SudokuCheckFunctionalTest extends TestCase
{
    public function testItPassesWhenBoardIsOk()
    {
        $check = new SudokuCheck();
        $expected = [
            'status' => true
        ];
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
        $this->assertEquals($expected, $check->check($board));
    }

    public function testItFailsWithDuplicatedNumberFound()
    {
        $check = new SudokuCheck();

        $board = [
            [1, 8, 2, 5, 4, 3, 6, 9, 7],
            [9, 6, 5, 1, 7, 8, 3, 4, 2],
            [7, 4, 3, 9, 6, 2, 8, 1, 5],
            [3, 7, 4, 8, 9, 6, 5, 2, 1],
            [6, 2, 8, 4, 5, 1, 7, 3, 9],
            [5, 1, 9, 2, 3, 3, 4, 6, 8],
            [2, 9, 7, 6, 8, 4, 1, 5, 3],
            [4, 3, 1, 7, 2, 5, 9, 8, 6],
            [8, 5, 6, 3, 1, 9, 2, 7, 4]
        ];
        $result = $check->check($board);
        $this->assertFalse($result['status']);
        $this->assertIsArray($result['errors']);
    }
}
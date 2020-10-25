<?php

namespace SudokuCheck;

use SudokuCheck\Checks\Validation;
use SudokuCheck\Checks\LinesCheck;
use SudokuCheck\Checks\BoxesCheck;
use SudokuCheck\Checks\ColumnsCheck;

class SudokuCheck
{
    public function check(array $board): array
    {
        $validation = new Validation();
        $checkLines = new LinesCheck();
        $checkColumns = new ColumnsCheck();
        $checkBoxes = new BoxesCheck();

        $chain = $validation->setNext($checkLines)->setNext($checkColumns)->setNext($checkBoxes);

        $result = $chain->check($board);
        if (count($result) === 0) {
            return ['status' => true];
        }

        return ['status' => false, 'errors' => $result];
    }
}

<?php

namespace SudokuCheck\Checks;

class ColumnsCheck extends Link implements Check
{
    public function check(array $board): array
    {
        $columns = [];
        $errors = [];

        for ($columnNum = 0; $columnNum < self::DEFINING_NUMBER; $columnNum++) {
            for ($lineNum = 0; $lineNum < self::DEFINING_NUMBER; $lineNum++) {
                $columns[$columnNum][$lineNum] = $board[$lineNum][$columnNum];
            }
            if (count(array_flip($columns[$columnNum])) < self::DEFINING_NUMBER) {
                $errors[] = 'duplicated value at column ' . ($columnNum + 1);
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return parent::check($board);
    }
}
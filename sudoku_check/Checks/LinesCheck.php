<?php

namespace SudokuCheck\Checks;

class LinesCheck extends Link implements Check
{
    public function check(array $board): array
    {
        $errors = [];

        foreach ($board as $l => $line) {
            if (count(array_flip($line)) < self::DEFINING_NUMBER) {
                $errors[] = 'duplicated value at line ' . ($l + 1);
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return parent::check($board);
    }
}

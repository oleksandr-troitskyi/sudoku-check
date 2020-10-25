<?php

namespace SudokuCheck\Checks;

class BoxesCheck extends Link implements Check
{
    public function check(array $board): array
    {
        $boxes = [];
        $boxNum = 0;
        $tactIterations = 0;
        $linesToBoxPassed = 0;

        foreach ($board as $line) {
            foreach ($line as $c => $cell) {
                $boxes[$boxNum][] = $cell;
                $tactIterations++;
                if ($tactIterations === self::BOXES_ON_LINE) {
                    $boxNum++;
                    $tactIterations = 0;
                }
            }
            $linesToBoxPassed++;
            if ($linesToBoxPassed < self::BOXES_ON_LINE) {
                $boxNum = $boxNum - self::BOXES_ON_LINE;
            }
            if ($linesToBoxPassed === self::BOXES_ON_LINE) {
                $linesToBoxPassed = 0;
            }
        }

        $errors = [];

        foreach ($boxes as $b => $box) {
            if (count(array_flip($box)) < self::DEFINING_NUMBER) {
                $errors[] = 'duplicated value at box ' . ($b + 1);
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return parent::check($board);
    }
}
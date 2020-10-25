<?php

namespace SudokuCheck\Checks;

class Validation extends Link implements Check
{
    public function check($board): array
    {
        if (count($board) === 0) {
            return ['empty board'];
        }
        if (count($board) < self::DEFINING_NUMBER) {
            return ['not enough lines'];
        }

        $errors = [];
        foreach ($board as $l => $line) {
            if (count($line) < self::DEFINING_NUMBER) {
                $errors[] = 'line '
                    . ($l + 1)
                    . ' have '
                    . count($line)
                    . ' cells, but should have '
                    . self::DEFINING_NUMBER;
                continue;
            }
            foreach ($line as $c => $cell) {
                if (!is_int($cell)) {
                    $errors[] = 'line '
                        . ($l + 1)
                        . ' cell '
                        . ($c + 1)
                        . ' should have integer value';
                }
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return parent::check($board);
    }
}

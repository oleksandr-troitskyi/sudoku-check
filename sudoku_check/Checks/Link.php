<?php

namespace SudokuCheck\Checks;

abstract class Link implements Check
{
    const DEFINING_NUMBER = 9;
    const BOXES_ON_LINE = 3;

    protected ?Check $next = null;

    public function setNext(Check $check): Check
    {
        $this->next = $check;

        return $check;
    }

    public function check(array $board): array
    {
        if (!is_null($this->next)) {
            return $this->next->check($board);
        }

        return [];
    }
}
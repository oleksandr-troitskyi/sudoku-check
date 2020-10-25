<?php

namespace SudokuCheck\Checks;

interface Check
{
    public function setNext(Check $next): Check;

    public function check(array $board): array;
}

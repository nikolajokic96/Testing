<?php

namespace MyApp\contracts;

use MyApp\DTO\Student;

interface FinalResults
{
    public const PASS = 'PASS';

    public const FAILED = 'FAILED';

    /**
     * Calculates student final result
     *
     * @param array $grades
     * @return string
     */
    public function finalResults(array $grades): string;

}
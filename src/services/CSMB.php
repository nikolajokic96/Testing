<?php

namespace MyApp\services;

use MyApp\contracts\FinalResults;
use MyApp\DTO\Student;

class CSMB implements FinalResults
{
    public const BOARD = 'CSMB';

    public const GRADE_TO_PASS = 8;

    /**
     * @inheritDoc
     *
     * @param Student $student
     */
    public function finalResults(array $grades): string
    {
        if (count($grades) > 2) {
            array_shift($grades);
        }

        foreach ($grades as $grade) {
            if ($grade > self::GRADE_TO_PASS) {
                return self::PASS;
            }
        }

        return self::FAILED;
    }
}
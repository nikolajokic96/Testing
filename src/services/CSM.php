<?php

namespace MyApp\services;

use JetBrains\PhpStorm\Pure;
use MyApp\contracts\FinalResults;

class CSM implements FinalResults
{
    public const BOARD = 'CSM';

    public const PASS_LIMIT = 7;

    /**
     * @inheritDoc
     *
     * @param array $grades
     */
    #[Pure] public function finalResults(array $grades): string
    {
        $gradeSum = 0;
        foreach ($grades as $grade) {
            $gradeSum += $grade;
        }

        $gradeAverage = $gradeSum / count($grades);

        return $gradeAverage >= self::PASS_LIMIT ? self::PASS : self::FAILED;
    }
}
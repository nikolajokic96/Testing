<?php

namespace MyApp\services;

use Exception;
use MyApp\DTO\Statistic;
use MyApp\repositories\StudentRepository;
use SimpleXMLElement;

class StudentService
{
    /**
     * @var StudentRepository
     */
    private StudentRepository $studentRepository;

    /**
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Returns student statistic
     *
     * @param string $id
     * @return string
     * @throws Exception
     */
    public function getStudentStatistic(string $id): string
    {
        $student = $this->studentRepository->getStudent($id);
        $grades = $student->getGrades();
        $passCondition = $student->getBoard() === CSM::BOARD ? new CSM() : new CSMB();

        if ($student->getBoard() === CSMB::BOARD && count($grades) > 2) {
            unset($grades[array_search(min($grades), $grades)]);
        }

        $statistic = new Statistic(
            $student->getName(),
            $student->getId(),
            $grades,
            $passCondition->finalResults($grades),
            $this->averageGrade($grades)
        );

        return $student->getBoard() === CSM::BOARD ?
            json_encode($statistic->toArray()) : $this->convertToXML($statistic->toArray());
    }

    /**
     * Calculates average student grade
     *
     * @param array $grades
     * @return float
     */
    private function averageGrade(array $grades): float
    {
        $gradeSum = 0;
        foreach ($grades as $grade) {
            $gradeSum += $grade;
        }

        return $gradeSum / count($grades);
    }

    /**
     * Converts array to simple xml
     *
     * @param $array
     * @param null $rootElement
     * @param null $xml
     * @return bool|string
     * @throws Exception
     */
    private function convertToXML($array, $rootElement = null, $xml = null): bool|string
    {
        $_xml = $xml;
        if ($_xml === null) {
            $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
        }

        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $this->convertToXML($v, $k, $_xml->addChild($k));
            } else {
                $_xml->addChild($k, $v);
            }
        }

        return $_xml->asXML();
    }
}
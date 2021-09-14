<?php

namespace MyApp\DTO;

class Statistic
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $studentId;
    /**
     * @var array
     */
    private array $grades;
    /**
     * @var string
     */
    private string $finalResult;
    /**
     * @var float
     */
    private float $averageGrade;

    /**
     * @param string $name
     * @param string $studentId
     * @param array $grades
     * @param string $finalResult
     * @param float $averageGrade
     */
    public function __construct(string $name, string $studentId, array $grades, string $finalResult, float $averageGrade)
    {
        $this->name = $name;
        $this->studentId = $studentId;
        $this->grades = $grades;
        $this->finalResult = $finalResult;
        $this->averageGrade = $averageGrade;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStudentId(): string
    {
        return $this->studentId;
    }

    /**
     * @return array
     */
    public function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @return string
     */
    public function getFinalResult(): string
    {
        return $this->finalResult;
    }

    /**
     * @return float
     */
    public function getAverageGrade(): float
    {
        return $this->averageGrade;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'studentId' => $this->getStudentId(),
            'studentName' => $this->getName(),
            'averageGrade' => $this->getAverageGrade(),
            'grades' => $this->getGrades(),
            'finalResult' => $this->getFinalResult(),
        ];
    }
}
<?php

namespace MyApp\DTO;

class Student
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var array
     */
    private array $grades;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $board;

    /**
     * @param int $id
     * @param array $grades
     * @param string $name
     * @param string $board
     */
    public function __construct(int $id, array $grades, string $name, string $board)
    {
        $this->id = $id;
        $this->grades = $grades;
        $this->name = $name;
        $this->board = $board;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBoard(): string
    {
        return $this->board;
    }
}
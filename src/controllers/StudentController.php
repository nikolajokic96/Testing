<?php

namespace MyApp\controllers;

use Exception;
use MyApp\database\DB;
use MyApp\helpers\Request;
use MyApp\services\StudentService;

class StudentController
{
    public const STUDENT_QUERY_PARAM = 'student';

    /**
     * @var StudentService
     */
    private StudentService $studentService;

    /**
     * @param StudentService $studentService
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Gets request for students statistic
     */
    public function index()
    {
        try {
            $this->isParamValid();
            echo $this->studentService->getStudentStatistic(Request::getQueryParam(self::STUDENT_QUERY_PARAM));
        } catch (Exception $e) {
            require_once(__DIR__ . '/../views/html/validQueryParam.phtml');
        }

        DB::closeConnection();
    }

    /**
     * Checks if query param is sent
     * @throws Exception
     */
    private function isParamValid()
    {
        $studentId = Request::getQueryParam(self::STUDENT_QUERY_PARAM);
        if (!$studentId) {
            throw new Exception('Please enter student id', 404);
        }
    }
}
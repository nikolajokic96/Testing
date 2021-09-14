<?php

namespace MyApp\repositories;

use Cassandra\Exception\ValidationException;
use Exception;
use MyApp\database\DB;
use MyApp\DTO\Student;

class StudentRepository
{
    /**
     * Returns student for given id
     *
     * @param string $id
     * @return Student
     * @throws Exception
     */
    public function getStudent(string $id): Student
    {
        $sql = 'SELECT * FROM students where id = ' . $id;
        $results = DB::executeQuery($sql);

        if (!$results) {
            throw new Exception('There are no user with given id!', 404);
        }

        $studentArray = reset($results);

        return new Student(
            $studentArray['id'],
            json_decode($studentArray['grades']),
            $studentArray['name'],
            $studentArray['board']
        );
    }
}
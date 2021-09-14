<?php

namespace MyApp\database;

use mysqli;
use SQLiteException;

/**
 * class DB
 */
class DB
{
    public const HOST = 'localhost';

    public const USERNAME = 'root';

    public const PASSWORD = '';

    public const DATABASE = 'school';

    /**
     * @var mysqli
     */
    public static mysqli $instance;

    /**
     * Gets mysql connection
     *
     * @return mysqli
     */
    public static function getConnection(): mysqli
    {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
            if (!self::$instance) {
                throw new SQLiteException('Connection Error' . mysqli_connect_error());
            }
        }

        return self::$instance;
    }

    /**
     * Executes given sql query
     *
     * @param string $query
     * @return array|null
     */
    public static function executeQuery(string $query): ?array
    {
        $result = mysqli_query(self::getConnection(), $query);
        $arrayResults = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);


        return $arrayResults;
    }

    /**
     * Close connection
     */
    public static function closeConnection()
    {
        if (isset(self::$instance)) {
            mysqli_close(self::$instance);
        }
    }

}
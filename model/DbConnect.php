<?php

namespace model;

use PDO;
use PDOException;

/**
 * @DbConnect allows you to create or get a connection to the database.
 */
class DbConnect
{
    private static ?PDO $conn = null;

    /**
     * Loads the environment variables necessary for the connection.
     * Those variables come from the .env file at the root of the project.
     * @return void
     */
    private static function loadEnv(): void
    {
        $filePath = dirname(__DIR__) . '/.env';
        if (!file_exists($filePath)) {
            die("Error : cannot find .env file !");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // if (str_starts_with(trim($line), '#')) continue;

            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if (!array_key_exists($key, $_ENV)) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }

    /**
     * Allows creating a connection to the database, or return an already existing connection.
     * @return PDO|null the connection to the database or null if connection cannot be established.
     */
    public static function getDb(): ?PDO
    {
        if (self::$conn == null) {
            self::loadEnv();
            $servername = getenv("DB_HOST") ?: die("Error : DB_HOST undefined in .env");
            $username = getenv("DB_USER") ?: die("Error : DB_USER undefined in .env");
            $password = getenv("DB_PASSWORD") ?: '';
            $dbname = getenv("DB_NAME") ?: die("Error : DB_NAME undefined in .env");
            $port = getenv("DB_PORT") ?: "5432"; //

            $dsn = "pgsql:host=localhost;dbname=$dbname";

            try {
                self::$conn = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Connection Error PostgreSQL : " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
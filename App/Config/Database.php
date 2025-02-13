<?php

namespace App\Config;

use PDO;
use Exception;

/**
 * Database configuration and connection class.
 *
 * This class uses the Singleton pattern to provide a single PDO instance.
 */
class Database
{
    /**
     * @var PDO|null Instance of the PDO connection.
     */
    protected static ?PDO $pdo = null;

    /**
     * Returns the PDO connection instance using the Singleton pattern.
     *
     * @return PDO The PDO connection instance.
     * @throws Exception If the configuration file is not found or the connection fails.
     */
    public static function getInstance(): PDO
    {
        if (!self::$pdo) {
            // Path to the configuration file
            $configFile = __DIR__ . '/Config.env';
            if (!file_exists($configFile)) {
                throw new Exception("Configuration file (Config.env) not found.");
            }

            // Load configuration settings
            $config = [];
            $lines = file($configFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Skip comments
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                list($key, $value) = explode('=', trim($line), 2);
                $config[$key] = $value;
            }

            // Set configuration variables
            $host    = $config['DB_HOST'] ?? 'localhost';
            $db      = $config['DB_NAME'] ?? '';
            $user    = $config['DB_USER'] ?? '';
            $pass    = $config['DB_PASSWORD'] ?? '';
            $charset = $config['DB_CHARSET'] ?? 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                self::$pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new Exception('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

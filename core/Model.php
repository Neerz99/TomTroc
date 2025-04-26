<?php

class Model
{
    /**
     * @var \PDO
     */
    protected static $db;

    public function __construct()
    {
        // If the database connection is not already established, create it
        if (self::$db === null) {
            try {
                $dsn = sprintf(
                    'mysql:host=%s;dbname=%s;charset=utf8mb4',
                    DB_HOST,
                    DB_NAME
                );
                self::$db = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                // Display an error message and terminate the script (Should be replaced in production)
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
    }

    /**
     * Retourne l'instance PDO pour faire des requêtes personnalisées
     *
     * @return \PDO
     */
    protected function getDb(): PDO
    {
        return self::$db;
    }
}

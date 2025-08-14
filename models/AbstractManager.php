<?php

class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        // Essaye EntityManager si dispo, sinon fallback PDO natif
        $this->db = $this->resolvePdo();
    }

    private function resolvePdo(): PDO
    {
        // Tentative via App::em()
        try {
            if (class_exists('App') && method_exists('App', 'em')) {
                $em = App::em(); // peut lancer une exception si non initialisé
                if ($em && method_exists($em, 'getConnection')) {
                    $pdo = $em->getConnection();
                    if ($pdo instanceof PDO) {
                        return $pdo;
                    }
                }
            }
        } catch (\Throwable $e) {
            // on ignore et on passe au fallback
        }

        // Fallback sur les constantes DB_*
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        return new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}

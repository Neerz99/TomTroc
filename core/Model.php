<?php

class Model
{
    /**
     * Instance PDO partagée par tous les modèles.
     * @var \PDO|null
     */
    protected static ?PDO $db = null;

    public function __construct()
    {
        // Si pas encore initialisée, on essaie d'abord via l'EntityManager (si présent),
        // puis on retombe sur une connexion PDO "classique" avec les constantes de config.
        if (self::$db === null) {

            // 1) Tentative via App::em()->getConnection() (EntityManager optionnel)
            try {
                if (class_exists('App') && method_exists('App', 'em')) {
                    $em = App::em(); // peut lever une exception si non initialisé
                    if ($em && method_exists($em, 'getConnection')) {
                        $pdo = $em->getConnection();
                        if ($pdo instanceof PDO) {
                            self::$db = $pdo;
                        }
                    }
                }
            } catch (\Throwable $e) {
                // On ignore et on passera au fallback PDO ci-dessous.
            }

            // 2) Fallback : connexion PDO directe depuis les constantes de config
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
                    // En prod : log + page d'erreur générique
                    die('Erreur de connexion à la base de données : ' . $e->getMessage());
                }
            }
        }
    }

    /**
     * Permet d'injecter manuellement une connexion PDO (tests, scripts, etc.).
     */
    public static function setConnection(PDO $pdo): void
    {
        self::$db = $pdo;
    }

    /**
     * Retourne l'instance PDO pour exécuter des requêtes.
     */
    protected function getDb(): PDO
    {
        return self::$db;
    }
}

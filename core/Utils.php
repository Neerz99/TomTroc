<?php

class Utils
{

    /**
     * Generate a URL with a format /controller/action/param1/param2...
     *
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return string
     */
    public static function url(string $controller, string $action = 'index', $params = []): string
    {
        if (!is_array($params)) {
            $params = [$params];
        }

        $url = BASE_PATH . '/' . $controller . '/' . $action;
        if (!empty($params)) {
            $url .= '/' . implode('/', array_map('urlencode', $params));
        }
        return $url;
    }


    /**
     * Redirect to a specific URL.
     *
     * @param string $controller
     * @param string $action
     * @param array $params
     */
    public static function redirect(string $controller, string $action = 'index', array $params = []): void
    {
        header('Location: ' . self::url($controller, $action, $params));
        exit;
    }

    /**
     * Sanitize a string to prevent XSS attacks.
     *
     * @param string $string
     * @return string
     */
    public static function sanitize(string $string): string
    {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get a value in $_POST or return a default value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function post(string $key, $default = null)
    {
        return isset($_POST[$key]) ? self::sanitize($_POST[$key]) : $default;
    }

    /**
     * Convert SQL date/time to french format
     *
     * @param string|\DateTime $date ISO or DateTime object
     * @param string $pattern Pattern (e.g. 'd MMMM yyyy to HH:mm')
     * @return string
     * @throws Exception
     */
    public static function formatDateFr($date, string $pattern = 'd MMMM yyyy'): string
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }
        $fmt = new \IntlDateFormatter(
            'fr_FR',
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            'Europe/Paris',
            \IntlDateFormatter::GREGORIAN,
            $pattern
        );
        return $fmt->format($date);
    }

    /**
     * Calculates a time duration from a given date to now.
     *
     * @param DateTime|string $dateIso
     * @return string
     * @throws Exception
     */
    public static function calculateDuration(DateTime|string $dateIso): string
    {
        // Transform to DateTime if needed
        $start = $dateIso instanceof \DateTime
            ? $dateIso
            : new \DateTime($dateIso);

        $now = new \DateTime();
        $interval = $start->diff($now);

        $parts = [];
        if ($interval->y > 0) {
            $parts[] = $interval->y . ' ' . ($interval->y > 1 ? 'ans' : 'an');
        }
        if ($interval->m > 0) {
            $parts[] = $interval->m . ' mois';
        }
        if ($interval->d > 0) {
            $parts[] = $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
        }

        if (empty($parts)) {
            return "Aujourd’hui";
        }

        // Return parts, separated by commas
        return implode(', ', array_slice($parts, 0, 3));
    }

    /**
     * Calculates the number of books
     */
    public static function booksCount($books): int
    {
        if (is_array($books)) {
            return count($books);
        } elseif ($books instanceof \Countable) {
            return count($books);
        } elseif (is_int($books)) {
            return $books;
        }
        return 0; // Default to 0 if not countable
    }

    /**
     * Truncate a string over x characters
     *
     * @param string $text
     * @param int $limit
     * @param string $suffix
     * @param bool $preserveWords
     * @param string|null $encoding
     *
     * @return string
     * @throws InvalidArgumentException if $limit is less than 1
     *
     */
    public static function truncate(
        string  $text,
        int     $limit = 100,
        string  $suffix = '…',
        bool    $preserveWords = true,
        ?string $encoding = null
    ): string
    {
        if ($limit < 1) {
            throw new InvalidArgumentException('$limit must be at least 1');
        }

        $encoding ??= mb_internal_encoding();
        $suffixLen = mb_strlen($suffix, $encoding);

        if ($suffixLen >= $limit) {
            return mb_substr($suffix, 0, $limit, $encoding);
        }

        if (mb_strlen($text, $encoding) <= $limit) {
            return $text;
        }

        $cut = $limit - $suffixLen;
        $snippet = mb_substr($text, 0, $cut, $encoding);

        if ($preserveWords) {
            $result = preg_replace('/\s+\S*$/u', '', $snippet);

            // If preg_replace fails, $snippet remains unchanged
            if (is_string($result)) {
                $snippet = $result;
            }
        }

        return rtrim($snippet) . $suffix;
    }
}
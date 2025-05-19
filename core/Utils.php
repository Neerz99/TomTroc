<?php

class Utils {

    /**
     * Generate a URL with a format /controller/action/param1/param2...
     *
     * @param string $controller
     * @param string $action
     * @param array  $params
     * @return string
     */
    public static function url(string $controller, string $action = 'index', $params = []): string
    {
        if (!is_array($params)) {
            $params = [ $params ];
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
     * @param array  $params
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
     * @param mixed  $default
     * @return mixed
     */
    public static function post(string $key, $default = null)
    {
        return isset($_POST[$key]) ? self::sanitize($_POST[$key]) : $default;
    }
}
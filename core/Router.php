<?php

class Router
{
    public function handleRequest()
    {
        // Get the URL and split it into segments
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        $segments = $url === '' ? [] : explode('/', $url);

        // Controller and action names
        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $actionName     = isset($segments[1]) ? $segments[1] : 'index';
        $params         = array_slice($segments, 2);

        // Controller file path
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            return $this->error404("Contrôleur '$controllerName' introuvable.");
        }

        require_once $controllerFile;
        if (!class_exists($controllerName)) {
            return $this->error404("Classe '$controllerName' introuvable.");
        }

        $controller = new $controllerName();
        if (!method_exists($controller, $actionName)) {
            return $this->error404("Action '$actionName' non trouvée dans '$controllerName'.");
        }

        // Call the action method with parameters
        call_user_func_array([$controller, $actionName], $params);
    }

    private function error404($message)
    {
        http_response_code(404);
        echo "<h1>Erreur 404</h1><p>$message</p>";
        exit;
    }
}

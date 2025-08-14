<?php

class Controller
{
    /**
     * Renders a view inside the main template.
     *
     * @param string $view    relative path, ex. 'home/index'
     * @param array  $data    data to be passed to the view
     */
    public function render(string $view, array $data = [])
    {
        extract($data);

        // Path to the view (ex. /views/templates/home/index.php)
        $viewFile = __DIR__ . '/../views/templates/' . $view . '.php';
        if (!file_exists($viewFile)) {
            http_response_code(404);
            echo "<h1>Erreur 404</h1><p>Vue introuvable : $viewFile</p>";
            exit;
        }

        // Start output buffering to capture the view content
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Load the main template
        require __DIR__ . '/../views/templates/main.php';
    }
}

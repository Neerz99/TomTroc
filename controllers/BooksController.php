<?php

class BooksController extends Controller
{
    /**
     * Display the list of books.
     */
    public function index()
    {
        $model = new BooksModel();
        $books = $model->findAllWithOwners();

        $this->render('books/index', [
            'title' => 'Nos livres à l’échange',
            'books' => $books
        ]);
    }

    /**
     * Display the details of a book.
     * @param int $id
     */
    public function detail($id)
    {
        $model = new BooksModel();
        $book = $model->find((int)$id);

        if (!$book) {
            http_response_code(404);
            echo "<h1>Erreur 404</h1><p>Livre introuvable.</p>";
            exit;
        }

        $this->render('books/detail', [
            'title' => 'Détail du livre',
            'book'  => $book
        ]);
    }

    /**
     * Form to add a new book.
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Suppose that the user is logged in and $_SESSION['user_id'] is set !!! TO VERIFY
            $data = [
                'ownerId'     => $_SESSION['user_id'],
                'title'       => Utils::sanitize($_POST['title'] ?? ''),
                'author'      => Utils::sanitize($_POST['author'] ?? ''),
                'imageUrl'    => Utils::sanitize($_POST['imageUrl'] ?? ''),
                'description' => Utils::sanitize($_POST['description'] ?? ''),
                'status'      => 'Available'
            ];
            $model = new BooksModel();
            if ($model->create($data)) {
                Utils::redirect('books', 'index');
            } else {
                $error = "Impossible de créer le livre.";
            }
        }

        // Display the form
        $this->render('books/add', [
            'title' => 'Ajouter un livre',
            'error' => $error ?? null
        ]);
    }
}

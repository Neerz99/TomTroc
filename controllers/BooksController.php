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

        // Get the owner of the book
        $ownerModel = new UserModel();
        $owner = $ownerModel->find($book['ownerId']);

        $this->render('books/detail', [
            'title' => 'Détail du livre',
            'book'  => $book,
            'owner' => $owner
        ]);
    }

    /**
     * Form to add a new book.
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $imagePath = null;
            if (!empty($_FILES['image']['tmp_name'])) {
                $allowedTypes = ['image/jpeg','image/png','image/gif'];
                $type = $_FILES['image']['type'];
                $size = $_FILES['image']['size'];

                if (in_array($type, $allowedTypes) && $size <= 5000000) {
                    $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $filename  = uniqid('book_', true) . '.' . $ext;
                    $destFs    = UPLOAD_DIR . $filename; // Path to the file on the server
                    $destUrl   = UPLOAD_URL . '/' . $filename; // URL to access the file

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $destFs)) {
                        $imagePath = $destUrl;
                    } else {
                        $error = "Erreur lors du déplacement de l'image.";
                    }
                } else {
                    $error = "Format invalide ou fichier trop volumineux (max 3 Mo).";
                }
            }


            $data = [
                'ownerId'     => $_SESSION['user_id'],
                'title'       => Utils::sanitize($_POST['title'] ?? ''),
                'author'      => Utils::sanitize($_POST['author'] ?? ''),
                'imageUrl'    => $imagePath,
                'description' => Utils::sanitize($_POST['description'] ?? ''),
                'status'      => 'Disponible'
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

    /**
     * Display the search results.
     */

    public function search(): void
    {
        $search = trim($_GET['search'] ?? '');

        if ($search === '') {
            $error = "Veuillez entrer un mot";
            // Does not interact with the database
            $books = [];
        } else {
            $model = new BooksModel();
            $books = $model->search($search);

            if (empty($books)) {
                $error = "Aucun livre trouvé pour « {$search} ».";
            }
        }

        // Render the view
        $this->render('books/search', [
            'title'  => 'Résultats de la recherche pour « ' . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . ' »',
            'books'  => $books,
            'error'  => $error ?? null,
            'search' => htmlspecialchars($search, ENT_QUOTES, 'UTF-8'),
        ]);
    }

}

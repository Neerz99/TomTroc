<?php

class MemberController extends Controller
{
    /**
     * Display the details of a member.
     * @param int $id
     */
    public function detail($id)
    {
        $model = new UserModel();
        $user = $model->find((int)$id);

        if (!$user) {
            http_response_code(404);
            echo "<h1>Erreur 404</h1><p>Membre introuvable.</p>";
            exit;
        }

        // Get the books owned by the user
        $booksModel = new BooksModel();
        $user['books'] = $booksModel->getUserBooks($user['id']);

        $this->render('members/detail', [
            'title' => 'Détail du membre',
            'user' => $user,
            'books' => $user['books'],
            'createdAt' => $user['createdAt'],
        ]);
    }
}
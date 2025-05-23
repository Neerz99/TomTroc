<?php

class AccountController extends Controller
{
    public function index()
    {
        // Check if the user is logged in
        if (empty($_SESSION['user_id'])) {
            Utils::redirect('user', 'login');
        }

        $userId = (int)$_SESSION['user_id'];

        // Get the user information
        $user = (new UserModel())->find($_SESSION['user_id']);
        if (!$user) {
            // If the user is not found, redirect to the login page
            Utils::redirect('user', 'login');
        }

        $books = (new BooksModel())->getUserBooks($userId);

        $this->render('account/index', [
            'title'     => 'Mon compte',
            'username'  => $user['username'],
            'email'     => $user['email'],
            'avatarUrl' => $user['avatarUrl'],
            'bio'       => $user['bio'],
            'createdAt' => $user['createdAt'],
            'books'     => $books,
        ]);
    }
}

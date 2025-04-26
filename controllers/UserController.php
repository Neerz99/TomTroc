<?php

class UserController extends Controller
{
    public function login()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = Utils::post('email');
            $password = $_POST['password'] ?? ''; // sanitize after validation

            $userModel = new UserModel();
            $user = $userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                Utils::redirect('books', 'index');
            } else {
                $error = 'Email ou mot de passe invalide.';
            }
        }

        $this->render('user/login', [
            'title' => 'Connexion',
            'error' => $error
        ]);
    }

    public function logout()
    {
        session_destroy();
        Utils::redirect('home', 'index');
    }

    /**
     * Check if the user is logged in.
     */
    public function isLogged()
    {
        if (!isset($_SESSION['user_id'])) {
            Utils::redirect('login', 'index');
        }
    }
}

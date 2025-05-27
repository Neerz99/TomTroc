<?php

class UserController extends Controller
{

    public function register()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get and sanitize the data from the form
            $username = Utils::post('username');
            $email = Utils::post('email');
            $pass = $_POST['password'] ?? '';
            $pass2 = $_POST['password2'] ?? '';

            // Basic validation
            if (empty($username) || empty($email) || empty($pass)) {
                $error = 'Tous les champs sont obligatoires.';
            } elseif ($pass !== $pass2) {
                $error = 'Les mots de passe ne correspondent pas.';
            } else {
                // Create user with UserModel
                $userModel = new UserModel();
                if ($userModel->create([
                    'username' => $username,
                    'email' => $email,
                    'password' => $pass,
                    'avatar_url' => $avatar ?? 'https://picsum.photos/200/300',
                ])) {
                    // Redirect to login page
                    Utils::redirect('user', 'login');
                } else {
                    $error = 'Impossible de créer votre compte.';
                }
            }
        }

        $this->render('user/register', [
            'title' => 'Inscription',
            'error' => $error
        ]);
    }


    public function login()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = Utils::post('email');
            $password = $_POST['password'] ?? ''; // sanitize after validation

            $userModel = new UserModel();
            $user = $userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
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
            Utils::redirect('user', 'login');
        }
    }
}
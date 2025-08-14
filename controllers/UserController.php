<?php

class UserController extends Controller
{
    public function register()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1) Récupération via filter_*
            $emailSan  = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email     = filter_var($emailSan, FILTER_VALIDATE_EMAIL);

            $username  = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
            $usernameOk = filter_var(
                $username,
                FILTER_VALIDATE_REGEXP,
                ['options' => ['regexp' => '/^[\p{L}0-9 _\.\-]{3,30}$/u']]
            );

            $pass   = filter_input(INPUT_POST, 'password',  FILTER_UNSAFE_RAW);
            $pass2  = filter_input(INPUT_POST, 'password2', FILTER_UNSAFE_RAW);
            $passOk = filter_var(
                $pass,
                FILTER_VALIDATE_REGEXP,
                ['options' => ['regexp' => '/^.{8,200}$/s']]
            );

            // 2) Vérifs
            if ($email === false || $usernameOk === false || $passOk === false) {
                $error = 'Merci de vérifier vos informations.';
            } elseif ($pass !== $pass2) {
                $error = 'Les mots de passe ne correspondent pas.';
            } else {
                // 3) Unicité email + création
                $userModel = new UserModel();

                if (method_exists($userModel, 'emailExists') && $userModel->emailExists($email)) {
                    $error = 'Email déjà utilisé.';
                } else {
                    $avatarUrl = 'https://picsum.photos/200/300'; // défaut si pas de champ avatar dans le form

                    $ok = $userModel->create([
                        'username'   => $username,
                        'email'      => $email,
                        'password'   => $pass,       // hashé dans le modèle
                        'avatar_url' => $avatarUrl,
                        'bio'        => null,
                    ]);

                    if ($ok) {
                        Utils::redirect('user', 'login');
                        return;
                    }
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
            // 1) Récupération + validation via filter_*
            $emailSan  = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email     = filter_var($emailSan, FILTER_VALIDATE_EMAIL);

            $password  = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
            $passwordOk = filter_var(
                $password,
                FILTER_VALIDATE_REGEXP,
                ['options' => ['regexp' => '/^.{6,200}$/s']]
            );

            if ($email === false || $passwordOk === false) {
                $error = 'Email ou mot de passe invalide.';
            } else {
                // 2) Auth
                $userModel = new UserModel();
                $user = $userModel->login($email, $password);

                if ($user) {
                    session_regenerate_id(true);
                    $_SESSION['user_id']  = (int)$user['id'];
                    $_SESSION['username'] = $user['username'];
                    Utils::redirect('books', 'index');
                    return;
                }
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

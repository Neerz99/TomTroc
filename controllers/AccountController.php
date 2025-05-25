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

    public function update()
    {
        if (empty($_SESSION['user_id'])) {
            Utils::redirect('user', 'login');
        }
        $uid       = (int)$_SESSION['user_id'];
        $userModel = new UserModel();

        // Fetch current record to get old avatar if needed
        $current = $userModel->find($uid);
        $avatarUrl = $current['avatarUrl'] ?? null;

        // Process avatar upload
        if (!empty($_FILES['avatar']['tmp_name'])) {
            $allowed = ['image/jpeg','image/png','image/gif'];
            $type    = $_FILES['avatar']['type'];
            $size    = $_FILES['avatar']['size'];

            if (in_array($type, $allowed) && $size <= 2 * 1024 * 1024) {
                $ext      = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('avatar_'.$uid.'_') . ".$ext";

                // ensure upload directory
                if (!is_dir(UPLOAD_DIR.'avatars/')) {
                    mkdir(UPLOAD_DIR.'avatars/', 0755, true);
                }

                $destFs  = UPLOAD_DIR . 'avatars/' . $filename;
                $destUrl = UPLOAD_URL  . '/avatars/' . $filename;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destFs)) {
                    $avatarUrl = $destUrl;
                }
            }
        }

        // Gather other fields
        $data = [
            'id'         => $uid,
            'username'   => Utils::sanitize($_POST['username'] ?? $current['username']),
            'email'      => Utils::sanitize($_POST['email']    ?? $current['email']),
            'bio'        => Utils::sanitize($_POST['bio']      ?? $current['bio']),
            'avatar_url'=> $avatarUrl,
        ];

        // Only include password if non-empty
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }

        // Save via UserModel
        $userModel->update($data);

        // Refresh session username
        $_SESSION['username'] = $data['username'];

        // Redirect back to account page
        Utils::redirect('account','index');
    }
}

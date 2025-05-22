<?php
require 'models/UserModel.php';
class AuthController
{

    private $userModel;
    public function __construct()
    {
        // session_start();
        $this->userModel = new UserModel();
    }
    public function register_view()
    {
        require 'views/register.php';
    }

    public function login_view()
    {
        require 'views/login.php';
    }

    public function register_post()
    {
        if (isset($_POST['submit'])) {
            $user = $this->userModel->getByEmail($_POST);
            if ($user) {
                $_SESSION['error'] = 'Email atau password salah';
                header('Location: /register');
                exit;
            } else {
                $this->userModel->registerUser($_POST);
                header('Location: /login');
            }
        }
    }
    public function login_post()
    {
        if (isset($_POST['submit'])) {
            $user = $this->userModel->checkCredential($_POST);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                header('Location: /home');
                exit;
            } else {
                $_SESSION['error'] = 'Email atau password salah';
                header('Location: /login');
                exit;
            }
        }
    }

    public function logout() {
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION = [];
        
        session_destroy();
        
        header('Location: /login');
        exit;
    }
}

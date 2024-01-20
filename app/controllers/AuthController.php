<?php

use App\Models\Db;
use App\Models\Auth;

class AuthController extends BaseController {

    /**
     * Register user
     */
    public function register() {
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = (new Auth(new Db));

            $requiredFields = ['name', 'email', 'address', 'user_type', 'password'];

            foreach ($requiredFields as $field) {
                ${$field} = $this->post($field) ?? '';
                if (empty($this->post($field))) {
                    $errors[$field] = ucfirst($field) . " is required.";
                }
            }

            $confirmPassword = $_POST['c_password'] ?? '';

            if ($password !== $confirmPassword) {
                $errors['password'] = "Password and confirm password do not match.";
            }

            if($auth->checkIfUserExists($this->post('email'))){
                $errors['email'] = "Email already exists.";
            } 

            if (empty($errors)) {
                $auth->registerUser($this->post('name'), $this->post('email'), $this->post('address'), $this->post('user_type'), $this->post('password'));
                $auth->loginUser($this->post('email'), $this->post('password'));
                $auth->isAuthenticated() ? $this->redirectTo('/') : null;
            }
        }
        $this->renderView('register', compact('errors'));
    }

    /**
     * Login user
     */
    public function login() {
        $error = '';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = (new Auth($this->db));
            $auth->loginUser($_POST['email'], $_POST['password']);
            $auth->isAuthenticated() ? $this->redirectTo('/') : null;
            $error = $auth->isAuthenticated() ? '' : 'Invalid email or password';
        }

        $this->renderView('login', compact('error'));
    }

    /**
     * Logout user
     */
    public function logout(){
        (new Auth(new Db))->logoutUser();

        $this->redirectTo('/');
    }
}

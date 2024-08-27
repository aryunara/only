<?php

namespace Controllers;

use Exception;
use Models\Model;
use Models\User;
use Models\UserIdentity;
use Requests\LoginRequest;
use Requests\RegistrationRequest;
use Service\SessionAuthenticationService;

class UserController
{
    private SessionAuthenticationService $authService;

    public function __construct()
    {
        $this->authService = new SessionAuthenticationService();
    }

    public function getRegistrate(): void
    {
        require_once './../Views/registrate.php';
    }

    public function postRegistrate(RegistrationRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $name = $request->getName();
            $phone = $request->getPhone();
            $email = $request->getEmail();
            $password = $request->getPassword();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $pdo = Model::getPdo();
            $pdo->beginTransaction();

            try {
                $user = User::create($name, $phone, $email);
                UserIdentity::create($user->getId(), $phone, $email, $hash);

                $pdo->commit();

                header('Location: /login');
            } catch (Exception $exception) {
                $pdo->rollBack();
            }
        }

        require_once './../Views/registrate.php';
    }

    public function getLogin(): void
    {
        require_once './../Views/login.php';
    }

    public function postLogin(LoginRequest $request) : void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $identityField = $request->getIdentityField();
            $password = $request->getPassword();

            $result = $this->authService->login($identityField, $password);

            if ($result) {
                header('Location: /profile');
            } else {
                $errors['identity_field'] = "Введены неверные данные для входа в аккаунт";
            }
        }

        require_once './../Views/login.php';
    }

    public function logout(): void
    {
        $this->authService->logout();

        header('Location: /main');
    }
}
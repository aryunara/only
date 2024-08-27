<?php

namespace Controllers;

use Exception;
use Models\Model;
use Models\User;
use Models\UserIdentity;
use Requests\ProfileRequest;
use Service\SessionAuthenticationService;

class ProfileController
{
    private SessionAuthenticationService $authService;

    public function __construct()
    {
        $this->authService = new SessionAuthenticationService();
    }

    public function getProfile(): void
    {
        if (!$this->authService->check()) {
            header('Location: /main');
        }

        $user = $this->authService->getCurrentUser();

        if (!$user) {
            header('Location: /main');
        }

        require_once './../Views/profile.php';
    }

    public function postProfile(ProfileRequest $request): void
    {
        $errors = $request->validate();
        $user = $this->authService->getCurrentUser();

        if (empty($errors)) {
            $userId = $request->getUserId();
            $name = $request->getName();
            $phone = $request->getPhone();
            $email = $request->getEmail();
            $password = $request->getPassword();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $pdo = Model::getPdo();
            $pdo->beginTransaction();

            try {
                User::update($userId, $name, $phone, $email);
                UserIdentity::update($userId, $phone, $email, $hash);

                $pdo->commit();

                header('Location: /profile');
            } catch (Exception $exception) {
                $pdo->rollBack();

                echo $exception->getMessage();
            }
        }

        require_once './../Views/profile.php';
    }
}
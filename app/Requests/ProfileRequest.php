<?php

namespace Requests;

use Models\User;

class ProfileRequest
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getUserId() : int
    {
        return $this->data['user_id'];
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getPhone(): string
    {
        return $this->data['phone'];
    }

    public function getEmail(): string
    {
        return $this->data['email'];
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

    public function validate(): array
    {
        $errors = [];

        if (isset($this->data['user_id'])) {
            $userId = $this->data['user_id'];
            if (empty($userId)) {
                $errors['user_id'] = "Поле 'Айди' должно быть заполнено";
            }
        } else {
            $errors['user_id'] = "Поле 'Айди' не указано";
        }

        if (isset($this->data['name'])) {
            $name = $this->data['name'];
            if (empty($name)) {
                $errors['name'] = "Поле 'Имя' должно быть заполнено";
            }
            if (strlen($name) < 2) {
                $errors['name'] = "Поле 'Имя' должно содержать 2 или более символа";
            }
            if (!empty(User::getOneByName($name))) {
                $errors['name'] = "Пользователь с таким именем уже зарегистрирован";
            }
        } else {
            $errors['name'] = "Поле 'Имя' не указано";
        }

        if (isset($this->data['phone'])) {
            $phone = $this->data['phone'];
            if (empty($phone)) {
                $errors['phone'] = "Поле 'Телефон' должно быть заполнено";
            }
            if (strlen($phone) !== 11) {
                $errors['phone'] = "Поле 'Телефон' должно содержать 11 символов";
            }
            if (!empty(User::getOneByPhone($phone))) {
                $errors['phone'] = "Пользователь с таким телефоном уже зарегистрирован";
            }
        } else {
            $errors['phone'] = "Поле 'Телефон' не указано";
        }

        if (isset($this->data['email'])) {
            $email = $this->data['email'];
            if (empty($email)) {
                $errors['email'] = "Поле 'Почта' должно быть заполнено";
            }
            if (!empty(User::getOneByEmail($email))) {
                $errors['email'] = "Пользователь с такой почтой уже зарегистрирован";
            }
            if (!str_contains($email, '@')) {
                $errors['email'] = "Укажите почту в правильном формате";
            }
        } else {
            $errors['email'] = "Поле 'Почта' не указано";
        }

        if (isset($this->data['password'])) {
            $password = $this->data['password'];
            if (empty($password)) {
                $errors['password'] = "Поле 'Пароль' должно быть заполнено";
            }
            if (strlen($password) < 6) {
                $errors['password'] = "Пароль должен содержать 6 или более символов";
            }
        } else {
            $errors['password'] = "Поле 'Пароль' не указано";
        }

        if (isset($this->data['password-repeat'])) {
            if (isset($this->data['password'])) {
                $passwordRep = $this->data['password-repeat'];
                $password = $this->data['password'];
                if (empty($passwordRep)) {
                    $errors['password-repeat'] = "Повторите пароль";
                }
                if ($password !== $passwordRep) {
                    $errors['password-repeat'] = "Пароли должны совпадать";
                }
            }
        } else {
            $errors['password-repeat'] = "Поле 'Повторите пароль' не указано";
        }

        return $errors;
    }

}
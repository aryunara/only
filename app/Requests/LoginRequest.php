<?php

namespace Requests;

use Service\YandexCaptchaService;

class LoginRequest
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getIdentityField(): string
    {
        return $this->data['identity_field'];
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

    public function getCaptchaToken()
    {
        return $this->data['smart-token'];
    }

    public function validate(): array
    {
        $errors = [];

        if (isset($this->data['identity_field'])) {
            $identityField = $this->data['identity_field'];
            if (empty($identityField)) {
                $errors['identity_field'] = "Поле 'Электронная почта или телефон' должно быть заполнено";
            }
        } else {
            $errors['identity_field'] = "Поле 'Электронная почта или телефон' не указано";
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
        if (isset($this->data['smart-token'])) {
            $token = $this->data['smart-token'];
            if (empty($token)) {
                $errors['captcha'] = "Поставьте галочку в поле 'Я не робот'";
            }
            $captchaService = new YandexCaptchaService();
            $isHuman = $captchaService->checkCaptcha($token);
            if (!$isHuman) {
                $errors['captcha'] = "Капча не пройдена. Перезагрузите страницу и попробуйте еще раз";
            }
        } else {
            $errors['captcha'] = "Поставьте галочку в поле 'Я не робот'";
        }

        return $errors;
    }
}
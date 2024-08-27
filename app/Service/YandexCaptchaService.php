<?php

namespace Service;

class YandexCaptchaService
{
    private const string SMARTCAPTCHA_SERVER_KEY = 'Серверный ключ';

    public function checkCaptcha(string $token) : bool
    {
        $ch = curl_init();
        $args = http_build_query([
            "secret" => self::SMARTCAPTCHA_SERVER_KEY,
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR'],
        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        $server_output = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }
        $resp = json_decode($server_output);

        return $resp->status === "ok";
    }
}
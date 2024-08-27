<?php

namespace Models;

class User extends Model
{
    private int $id;
    private string $name;
    private string $phone;
    private string $email;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __construct(int $id, string $name, string $phone, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public static function create(string $name, string $phone, string $email): ?User
    {
        $stmt = self::getPdo()->prepare("INSERT INTO users (name, phone, email) VALUES (:name, :phone, :email) RETURNING id");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'email' => $email]);
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new self($data['id'], $name, $phone, $email);
    }

    public static function update(int $userId, string $name, string $phone, string $email): void
    {
        $stmt = self::getPdo()->prepare("UPDATE users SET name = :name, phone = :phone, email = :email WHERE id = :userId");
        $stmt->execute(['userId' => $userId, 'name' => $name, 'phone' => $phone, 'email' => $email]);
    }

    public static function getOneById(string $id) : ?User
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return new User($data['id'], $data['name'], $data['phone'], $data['email']);
    }

    public static function getOneByName(string $name) : ?User
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM users WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return new User($data['id'], $data['name'], $data['phone'], $data['email']);
    }

    public static function getOneByPhone(string $phone) : ?User
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM users WHERE phone = :phone");
        $stmt->execute(['phone' => $phone]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return new User($data['id'], $data['name'], $data['phone'], $data['email']);
    }

    public static function getOneByEmail(string $email) : ?User
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return new User($data['id'], $data['name'], $data['phone'], $data['email']);
    }
}
<?php

namespace Models;

class UserIdentity extends Model
{
    private int $id;
    private int $userId;
    private string $identityType;
    private string $identityField;
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getIdentityType() : string
    {
        return $this->identityType;
    }

    public function getIdentityField(): string
    {
        return $this->identityField;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function __construct(int $id, int $userId, string $identityType, string $identityField, string $password)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->identityType = $identityType;
        $this->identityField = $identityField;
        $this->password = $password;
    }

    public static function create(int $userId, string $phone, string $email, string $hash) : void
    {
        $stmt = self::getPdo()->prepare("INSERT INTO user_identity (user_id, identity_type, identity_field, password) VALUES (:userId, 'phone', :phone, :hash)");
        $stmt->execute(['userId' => $userId, 'phone' => $phone, 'hash' => $hash]);

        $stmt = self::getPdo()->prepare("INSERT INTO user_identity (user_id, identity_type, identity_field, password) VALUES (:userId, 'email', :email, :hash)");
        $stmt->execute(['userId' => $userId, 'email' => $email, 'hash' => $hash]);
    }

    public static function update(int $userId, string $phone, string $email, string $hash) : void
    {
        $stmt = self::getPdo()->prepare("UPDATE user_identity SET identity_field = :phone, password = :hash WHERE user_id = :userId AND identity_type = 'phone'");
        $stmt->execute(['userId' => $userId, 'phone' => $phone, 'hash' => $hash]);

        $stmt = self::getPdo()->prepare("UPDATE user_identity SET identity_field = :email, password = :hash WHERE user_id = :userId AND identity_type = 'email'");
        $stmt->execute(['userId' => $userId, 'email' => $email, 'hash' => $hash]);
    }

    public static function getOneByIdentityField(string $identityField): ?UserIdentity
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM user_identity WHERE identity_field = :identityField");
        $stmt->execute(['identityField' => $identityField]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return new UserIdentity($data['id'], $data['user_id'], $data['identity_type'], $data['identity_field'], $data['password']);
    }
}
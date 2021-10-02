<?php

declare(strict_types=1);

namespace WordPress\WpUsers;

use JsonSerializable;

class WpUsersModel implements JsonSerializable
{
    private int $id;
    private string $userLogin;
    private string $userPass;
    private string $userNicename;
    private string $userEmail;
    private string $userUrl;
    private string $userRegistered;
    private string $userActivationKey;
    private int $userStatus;
    private string $displayName;

    public function __construct(WpUsersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->id = $dto->id;
        $this->userLogin = $dto->userLogin;
        $this->userPass = $dto->userPass;
        $this->userNicename = $dto->userNicename;
        $this->userEmail = $dto->userEmail;
        $this->userUrl = $dto->userUrl;
        $this->userRegistered = $dto->userRegistered;
        $this->userActivationKey = $dto->userActivationKey;
        $this->userStatus = $dto->userStatus;
        $this->displayName = $dto->displayName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    public function setUserLogin(string $userLogin): void
    {
        $this->userLogin = $userLogin;
    }

    public function getUserPass(): string
    {
        return $this->userPass;
    }

    public function setUserPass(string $userPass): void
    {
        $this->userPass = $userPass;
    }

    public function getUserNicename(): string
    {
        return $this->userNicename;
    }

    public function setUserNicename(string $userNicename): void
    {
        $this->userNicename = $userNicename;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    public function getUserUrl(): string
    {
        return $this->userUrl;
    }

    public function setUserUrl(string $userUrl): void
    {
        $this->userUrl = $userUrl;
    }

    public function getUserRegistered(): string
    {
        return $this->userRegistered;
    }

    public function setUserRegistered(string $userRegistered): void
    {
        $this->userRegistered = $userRegistered;
    }

    public function getUserActivationKey(): string
    {
        return $this->userActivationKey;
    }

    public function setUserActivationKey(string $userActivationKey): void
    {
        $this->userActivationKey = $userActivationKey;
    }

    public function getUserStatus(): int
    {
        return $this->userStatus;
    }

    public function setUserStatus(int $userStatus): void
    {
        $this->userStatus = $userStatus;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    public function toDto(): WpUsersDto
    {
        $dto = new WpUsersDto();
        $dto->id = (int) ($this->id ?? 0);
        $dto->userLogin = $this->userLogin ?? "";
        $dto->userPass = $this->userPass ?? "";
        $dto->userNicename = $this->userNicename ?? "";
        $dto->userEmail = $this->userEmail ?? "";
        $dto->userUrl = $this->userUrl ?? "";
        $dto->userRegistered = $this->userRegistered ?? "";
        $dto->userActivationKey = $this->userActivationKey ?? "";
        $dto->userStatus = (int) ($this->userStatus ?? 0);
        $dto->displayName = $this->displayName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "ID" => $this->id,
            "user_login" => $this->userLogin,
            "user_pass" => $this->userPass,
            "user_nicename" => $this->userNicename,
            "user_email" => $this->userEmail,
            "user_url" => $this->userUrl,
            "user_registered" => $this->userRegistered,
            "user_activation_key" => $this->userActivationKey,
            "user_status" => $this->userStatus,
            "display_name" => $this->displayName,
        ];
    }
}
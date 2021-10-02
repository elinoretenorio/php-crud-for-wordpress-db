<?php

declare(strict_types=1);

namespace WordPress\WpUsers;

class WpUsersDto 
{
    public int $id;
    public string $userLogin;
    public string $userPass;
    public string $userNicename;
    public string $userEmail;
    public string $userUrl;
    public string $userRegistered;
    public string $userActivationKey;
    public int $userStatus;
    public string $displayName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->id = (int) ($row["ID"] ?? 0);
        $this->userLogin = $row["user_login"] ?? "";
        $this->userPass = $row["user_pass"] ?? "";
        $this->userNicename = $row["user_nicename"] ?? "";
        $this->userEmail = $row["user_email"] ?? "";
        $this->userUrl = $row["user_url"] ?? "";
        $this->userRegistered = $row["user_registered"] ?? "";
        $this->userActivationKey = $row["user_activation_key"] ?? "";
        $this->userStatus = (int) ($row["user_status"] ?? 0);
        $this->displayName = $row["display_name"] ?? "";
    }
}
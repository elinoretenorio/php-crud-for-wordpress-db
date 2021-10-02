<?php

declare(strict_types=1);

namespace WordPress\WpUsers;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpUsersRepository implements IWpUsersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpUsersDto $dto): int
    {
        $sql = "INSERT INTO `wp_users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->userLogin,
                $dto->userPass,
                $dto->userNicename,
                $dto->userEmail,
                $dto->userUrl,
                $dto->userRegistered,
                $dto->userActivationKey,
                $dto->userStatus,
                $dto->displayName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpUsersDto $dto): int
    {
        $sql = "UPDATE `wp_users` SET `user_login` = ?, `user_pass` = ?, `user_nicename` = ?, `user_email` = ?, `user_url` = ?, `user_registered` = ?, `user_activation_key` = ?, `user_status` = ?, `display_name` = ?
                WHERE `ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->userLogin,
                $dto->userPass,
                $dto->userNicename,
                $dto->userEmail,
                $dto->userUrl,
                $dto->userRegistered,
                $dto->userActivationKey,
                $dto->userStatus,
                $dto->displayName,
                $dto->id
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $id): ?WpUsersDto
    {
        $sql = "SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`
                FROM `wp_users` WHERE `ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$id]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpUsersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`
                FROM `wp_users`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpUsersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $id): int
    {
        $sql = "DELETE FROM `wp_users` WHERE `ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$id]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
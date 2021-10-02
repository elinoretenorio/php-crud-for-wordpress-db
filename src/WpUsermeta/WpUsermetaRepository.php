<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpUsermetaRepository implements IWpUsermetaRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpUsermetaDto $dto): int
    {
        $sql = "INSERT INTO `wp_usermeta` (`user_id`, `meta_key`, `meta_value`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->userId,
                $dto->metaKey,
                $dto->metaValue
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpUsermetaDto $dto): int
    {
        $sql = "UPDATE `wp_usermeta` SET `user_id` = ?, `meta_key` = ?, `meta_value` = ?
                WHERE `umeta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->userId,
                $dto->metaKey,
                $dto->metaValue,
                $dto->umetaId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $umetaId): ?WpUsermetaDto
    {
        $sql = "SELECT `umeta_id`, `user_id`, `meta_key`, `meta_value`
                FROM `wp_usermeta` WHERE `umeta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$umetaId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpUsermetaDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `umeta_id`, `user_id`, `meta_key`, `meta_value`
                FROM `wp_usermeta`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpUsermetaDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $umetaId): int
    {
        $sql = "DELETE FROM `wp_usermeta` WHERE `umeta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$umetaId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
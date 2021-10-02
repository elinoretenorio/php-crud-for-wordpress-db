<?php

declare(strict_types=1);

namespace WordPress\WpPostmeta;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpPostmetaRepository implements IWpPostmetaRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpPostmetaDto $dto): int
    {
        $sql = "INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->postId,
                $dto->metaKey,
                $dto->metaValue
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpPostmetaDto $dto): int
    {
        $sql = "UPDATE `wp_postmeta` SET `post_id` = ?, `meta_key` = ?, `meta_value` = ?
                WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->postId,
                $dto->metaKey,
                $dto->metaValue,
                $dto->metaId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $metaId): ?WpPostmetaDto
    {
        $sql = "SELECT `meta_id`, `post_id`, `meta_key`, `meta_value`
                FROM `wp_postmeta` WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$metaId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpPostmetaDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `meta_id`, `post_id`, `meta_key`, `meta_value`
                FROM `wp_postmeta`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpPostmetaDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $metaId): int
    {
        $sql = "DELETE FROM `wp_postmeta` WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$metaId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
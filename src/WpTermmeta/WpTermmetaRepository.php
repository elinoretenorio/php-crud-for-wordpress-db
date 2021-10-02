<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpTermmetaRepository implements IWpTermmetaRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpTermmetaDto $dto): int
    {
        $sql = "INSERT INTO `wp_termmeta` (`term_id`, `meta_key`, `meta_value`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->termId,
                $dto->metaKey,
                $dto->metaValue
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpTermmetaDto $dto): int
    {
        $sql = "UPDATE `wp_termmeta` SET `term_id` = ?, `meta_key` = ?, `meta_value` = ?
                WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->termId,
                $dto->metaKey,
                $dto->metaValue,
                $dto->metaId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $metaId): ?WpTermmetaDto
    {
        $sql = "SELECT `meta_id`, `term_id`, `meta_key`, `meta_value`
                FROM `wp_termmeta` WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$metaId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpTermmetaDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `meta_id`, `term_id`, `meta_key`, `meta_value`
                FROM `wp_termmeta`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpTermmetaDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $metaId): int
    {
        $sql = "DELETE FROM `wp_termmeta` WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$metaId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
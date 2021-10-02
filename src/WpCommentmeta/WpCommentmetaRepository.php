<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpCommentmetaRepository implements IWpCommentmetaRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpCommentmetaDto $dto): int
    {
        $sql = "INSERT INTO `wp_commentmeta` (`comment_id`, `meta_key`, `meta_value`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->commentId,
                $dto->metaKey,
                $dto->metaValue
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpCommentmetaDto $dto): int
    {
        $sql = "UPDATE `wp_commentmeta` SET `comment_id` = ?, `meta_key` = ?, `meta_value` = ?
                WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->commentId,
                $dto->metaKey,
                $dto->metaValue,
                $dto->metaId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $metaId): ?WpCommentmetaDto
    {
        $sql = "SELECT `meta_id`, `comment_id`, `meta_key`, `meta_value`
                FROM `wp_commentmeta` WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$metaId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpCommentmetaDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `meta_id`, `comment_id`, `meta_key`, `meta_value`
                FROM `wp_commentmeta`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpCommentmetaDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $metaId): int
    {
        $sql = "DELETE FROM `wp_commentmeta` WHERE `meta_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$metaId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
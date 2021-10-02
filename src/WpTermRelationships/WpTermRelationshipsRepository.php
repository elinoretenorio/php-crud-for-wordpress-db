<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpTermRelationshipsRepository implements IWpTermRelationshipsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpTermRelationshipsDto $dto): int
    {
        $sql = "INSERT INTO `wp_term_relationships` (`term_taxonomy_id`, `term_order`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->termTaxonomyId,
                $dto->termOrder
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpTermRelationshipsDto $dto): int
    {
        $sql = "UPDATE `wp_term_relationships` SET `term_taxonomy_id` = ?, `term_order` = ?
                WHERE `object_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->termTaxonomyId,
                $dto->termOrder,
                $dto->objectId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $objectId): ?WpTermRelationshipsDto
    {
        $sql = "SELECT `object_id`, `term_taxonomy_id`, `term_order`
                FROM `wp_term_relationships` WHERE `object_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$objectId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpTermRelationshipsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `object_id`, `term_taxonomy_id`, `term_order`
                FROM `wp_term_relationships`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpTermRelationshipsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $objectId): int
    {
        $sql = "DELETE FROM `wp_term_relationships` WHERE `object_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$objectId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
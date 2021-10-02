<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpTermTaxonomyRepository implements IWpTermTaxonomyRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpTermTaxonomyDto $dto): int
    {
        $sql = "INSERT INTO `wp_term_taxonomy` (`term_id`, `taxonomy`, `description`, `parent`, `count`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->termId,
                $dto->taxonomy,
                $dto->description,
                $dto->parent,
                $dto->count
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpTermTaxonomyDto $dto): int
    {
        $sql = "UPDATE `wp_term_taxonomy` SET `term_id` = ?, `taxonomy` = ?, `description` = ?, `parent` = ?, `count` = ?
                WHERE `term_taxonomy_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->termId,
                $dto->taxonomy,
                $dto->description,
                $dto->parent,
                $dto->count,
                $dto->termTaxonomyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $termTaxonomyId): ?WpTermTaxonomyDto
    {
        $sql = "SELECT `term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`
                FROM `wp_term_taxonomy` WHERE `term_taxonomy_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$termTaxonomyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpTermTaxonomyDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`
                FROM `wp_term_taxonomy`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpTermTaxonomyDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $termTaxonomyId): int
    {
        $sql = "DELETE FROM `wp_term_taxonomy` WHERE `term_taxonomy_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$termTaxonomyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
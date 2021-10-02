<?php

declare(strict_types=1);

namespace WordPress\WpTerms;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpTermsRepository implements IWpTermsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpTermsDto $dto): int
    {
        $sql = "INSERT INTO `wp_terms` (`name`, `slug`, `term_group`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->slug,
                $dto->termGroup
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpTermsDto $dto): int
    {
        $sql = "UPDATE `wp_terms` SET `name` = ?, `slug` = ?, `term_group` = ?
                WHERE `term_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->slug,
                $dto->termGroup,
                $dto->termId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $termId): ?WpTermsDto
    {
        $sql = "SELECT `term_id`, `name`, `slug`, `term_group`
                FROM `wp_terms` WHERE `term_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$termId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpTermsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `term_id`, `name`, `slug`, `term_group`
                FROM `wp_terms`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpTermsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $termId): int
    {
        $sql = "DELETE FROM `wp_terms` WHERE `term_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$termId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
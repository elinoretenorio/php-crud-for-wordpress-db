<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpOptionsRepository implements IWpOptionsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpOptionsDto $dto): int
    {
        $sql = "INSERT INTO `wp_options` (`option_name`, `option_value`, `autoload`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->optionName,
                $dto->optionValue,
                $dto->autoload
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpOptionsDto $dto): int
    {
        $sql = "UPDATE `wp_options` SET `option_name` = ?, `option_value` = ?, `autoload` = ?
                WHERE `option_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->optionName,
                $dto->optionValue,
                $dto->autoload,
                $dto->optionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $optionId): ?WpOptionsDto
    {
        $sql = "SELECT `option_id`, `option_name`, `option_value`, `autoload`
                FROM `wp_options` WHERE `option_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$optionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpOptionsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `option_id`, `option_name`, `option_value`, `autoload`
                FROM `wp_options`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpOptionsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $optionId): int
    {
        $sql = "DELETE FROM `wp_options` WHERE `option_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$optionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
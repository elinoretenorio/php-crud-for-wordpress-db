<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpLinksRepository implements IWpLinksRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpLinksDto $dto): int
    {
        $sql = "INSERT INTO `wp_links` (`link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->linkUrl,
                $dto->linkName,
                $dto->linkImage,
                $dto->linkTarget,
                $dto->linkDescription,
                $dto->linkVisible,
                $dto->linkOwner,
                $dto->linkRating,
                $dto->linkUpdated,
                $dto->linkRel,
                $dto->linkNotes,
                $dto->linkRss
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpLinksDto $dto): int
    {
        $sql = "UPDATE `wp_links` SET `link_url` = ?, `link_name` = ?, `link_image` = ?, `link_target` = ?, `link_description` = ?, `link_visible` = ?, `link_owner` = ?, `link_rating` = ?, `link_updated` = ?, `link_rel` = ?, `link_notes` = ?, `link_rss` = ?
                WHERE `link_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->linkUrl,
                $dto->linkName,
                $dto->linkImage,
                $dto->linkTarget,
                $dto->linkDescription,
                $dto->linkVisible,
                $dto->linkOwner,
                $dto->linkRating,
                $dto->linkUpdated,
                $dto->linkRel,
                $dto->linkNotes,
                $dto->linkRss,
                $dto->linkId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $linkId): ?WpLinksDto
    {
        $sql = "SELECT `link_id`, `link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`
                FROM `wp_links` WHERE `link_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$linkId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpLinksDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `link_id`, `link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`
                FROM `wp_links`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpLinksDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $linkId): int
    {
        $sql = "DELETE FROM `wp_links` WHERE `link_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$linkId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
<?php

declare(strict_types=1);

namespace WordPress\WpPosts;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpPostsRepository implements IWpPostsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpPostsDto $dto): int
    {
        $sql = "INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->postAuthor,
                $dto->postDate,
                $dto->postDateGmt,
                $dto->postContent,
                $dto->postTitle,
                $dto->postExcerpt,
                $dto->postStatus,
                $dto->commentStatus,
                $dto->pingStatus,
                $dto->postPassword,
                $dto->postName,
                $dto->toPing,
                $dto->pinged,
                $dto->postModified,
                $dto->postModifiedGmt,
                $dto->postContentFiltered,
                $dto->postParent,
                $dto->guid,
                $dto->menuOrder,
                $dto->postType,
                $dto->postMimeType
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpPostsDto $dto): int
    {
        $sql = "UPDATE `wp_posts` SET `post_author` = ?, `post_date` = ?, `post_date_gmt` = ?, `post_content` = ?, `post_title` = ?, `post_excerpt` = ?, `post_status` = ?, `comment_status` = ?, `ping_status` = ?, `post_password` = ?, `post_name` = ?, `to_ping` = ?, `pinged` = ?, `post_modified` = ?, `post_modified_gmt` = ?, `post_content_filtered` = ?, `post_parent` = ?, `guid` = ?, `menu_order` = ?, `post_type` = ?, `post_mime_type` = ?
                WHERE `ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->postAuthor,
                $dto->postDate,
                $dto->postDateGmt,
                $dto->postContent,
                $dto->postTitle,
                $dto->postExcerpt,
                $dto->postStatus,
                $dto->commentStatus,
                $dto->pingStatus,
                $dto->postPassword,
                $dto->postName,
                $dto->toPing,
                $dto->pinged,
                $dto->postModified,
                $dto->postModifiedGmt,
                $dto->postContentFiltered,
                $dto->postParent,
                $dto->guid,
                $dto->menuOrder,
                $dto->postType,
                $dto->postMimeType,
                $dto->id
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $id): ?WpPostsDto
    {
        $sql = "SELECT `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`
                FROM `wp_posts` WHERE `ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$id]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpPostsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`
                FROM `wp_posts`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpPostsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $id): int
    {
        $sql = "DELETE FROM `wp_posts` WHERE `ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$id]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}
<?php

declare(strict_types=1);

namespace WordPress\Tests\WpPosts;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpPosts\{ WpPostsDto, IWpPostsRepository, WpPostsRepository };

class WpPostsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpPostsDto $dto;
    private IWpPostsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "ID" => 7280,
            "post_author" => 3111,
            "post_date" => "2021-10-13 11:51:35",
            "post_date_gmt" => "2021-09-21 05:36:08",
            "post_content" => "Certainly sort we popular such crime. Where recognize nor compare so sure. Clearly computer clear technology notice follow. Since care head.",
            "post_title" => "Benefit success media structure investment company. Owner Congress join open enter. Rock number so firm ever Mrs.",
            "post_excerpt" => "Home money discussion focus task Mr leave. Receive care wind some fast short this. Where can turn century author ok shake. Film yet sit civil.",
            "post_status" => "military",
            "comment_status" => "early",
            "ping_status" => "movie",
            "post_password" => "woman",
            "post_name" => "theory",
            "to_ping" => "Guy majority indicate common body feeling. Car value cell father. Democratic probably today bill citizen wish.",
            "pinged" => "Year American forward piece toward media provide individual. Somebody kitchen authority surface glass add everyone audience.",
            "post_modified" => "2021-10-11 23:18:53",
            "post_modified_gmt" => "2021-09-29 21:29:30",
            "post_content_filtered" => "Quite position perhaps. Past receive style me cost.",
            "post_parent" => 4817,
            "guid" => "hot",
            "menu_order" => 6993,
            "post_type" => "themselves",
            "post_mime_type" => "choose",
        ];
        $this->dto = new WpPostsDto($this->input);
        $this->repository = new WpPostsRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 2035;

        $sql = "INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->postAuthor,
                $this->dto->postDate,
                $this->dto->postDateGmt,
                $this->dto->postContent,
                $this->dto->postTitle,
                $this->dto->postExcerpt,
                $this->dto->postStatus,
                $this->dto->commentStatus,
                $this->dto->pingStatus,
                $this->dto->postPassword,
                $this->dto->postName,
                $this->dto->toPing,
                $this->dto->pinged,
                $this->dto->postModified,
                $this->dto->postModifiedGmt,
                $this->dto->postContentFiltered,
                $this->dto->postParent,
                $this->dto->guid,
                $this->dto->menuOrder,
                $this->dto->postType,
                $this->dto->postMimeType
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 8852;

        $sql = "UPDATE `wp_posts` SET `post_author` = ?, `post_date` = ?, `post_date_gmt` = ?, `post_content` = ?, `post_title` = ?, `post_excerpt` = ?, `post_status` = ?, `comment_status` = ?, `ping_status` = ?, `post_password` = ?, `post_name` = ?, `to_ping` = ?, `pinged` = ?, `post_modified` = ?, `post_modified_gmt` = ?, `post_content_filtered` = ?, `post_parent` = ?, `guid` = ?, `menu_order` = ?, `post_type` = ?, `post_mime_type` = ?
                WHERE `ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->postAuthor,
                $this->dto->postDate,
                $this->dto->postDateGmt,
                $this->dto->postContent,
                $this->dto->postTitle,
                $this->dto->postExcerpt,
                $this->dto->postStatus,
                $this->dto->commentStatus,
                $this->dto->pingStatus,
                $this->dto->postPassword,
                $this->dto->postName,
                $this->dto->toPing,
                $this->dto->pinged,
                $this->dto->postModified,
                $this->dto->postModifiedGmt,
                $this->dto->postContentFiltered,
                $this->dto->postParent,
                $this->dto->guid,
                $this->dto->menuOrder,
                $this->dto->postType,
                $this->dto->postMimeType,
                $this->dto->id
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $id = 2337;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($id);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $id = 1419;

        $sql = "SELECT `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`
                FROM `wp_posts` WHERE `ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$id]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($id);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`
                FROM `wp_posts`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $id = 1590;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($id);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $id = 1096;
        $expected = 8589;

        $sql = "DELETE FROM `wp_posts` WHERE `ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$id]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($id);
        $this->assertEquals($expected, $actual);
    }
}
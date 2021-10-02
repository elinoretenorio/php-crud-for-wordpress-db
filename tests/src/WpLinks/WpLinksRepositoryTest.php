<?php

declare(strict_types=1);

namespace WordPress\Tests\WpLinks;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpLinks\{ WpLinksDto, IWpLinksRepository, WpLinksRepository };

class WpLinksRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpLinksDto $dto;
    private IWpLinksRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "link_id" => 6085,
            "link_url" => "behind",
            "link_name" => "second",
            "link_image" => "gun",
            "link_target" => "marriage",
            "link_description" => "such",
            "link_visible" => "kind",
            "link_owner" => 9987,
            "link_rating" => 1164,
            "link_updated" => "2021-10-04 09:32:35",
            "link_rel" => "agency",
            "link_notes" => "Cover talk thank. Factor child cup series both.",
            "link_rss" => "own",
        ];
        $this->dto = new WpLinksDto($this->input);
        $this->repository = new WpLinksRepository($this->db);
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
        $expected = 3870;

        $sql = "INSERT INTO `wp_links` (`link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->linkUrl,
                $this->dto->linkName,
                $this->dto->linkImage,
                $this->dto->linkTarget,
                $this->dto->linkDescription,
                $this->dto->linkVisible,
                $this->dto->linkOwner,
                $this->dto->linkRating,
                $this->dto->linkUpdated,
                $this->dto->linkRel,
                $this->dto->linkNotes,
                $this->dto->linkRss
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
        $expected = 7593;

        $sql = "UPDATE `wp_links` SET `link_url` = ?, `link_name` = ?, `link_image` = ?, `link_target` = ?, `link_description` = ?, `link_visible` = ?, `link_owner` = ?, `link_rating` = ?, `link_updated` = ?, `link_rel` = ?, `link_notes` = ?, `link_rss` = ?
                WHERE `link_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->linkUrl,
                $this->dto->linkName,
                $this->dto->linkImage,
                $this->dto->linkTarget,
                $this->dto->linkDescription,
                $this->dto->linkVisible,
                $this->dto->linkOwner,
                $this->dto->linkRating,
                $this->dto->linkUpdated,
                $this->dto->linkRel,
                $this->dto->linkNotes,
                $this->dto->linkRss,
                $this->dto->linkId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $linkId = 4101;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($linkId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $linkId = 1040;

        $sql = "SELECT `link_id`, `link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`
                FROM `wp_links` WHERE `link_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$linkId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($linkId);
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
        $sql = "SELECT `link_id`, `link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`
                FROM `wp_links`";

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
        $linkId = 4554;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($linkId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $linkId = 1585;
        $expected = 7554;

        $sql = "DELETE FROM `wp_links` WHERE `link_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$linkId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($linkId);
        $this->assertEquals($expected, $actual);
    }
}
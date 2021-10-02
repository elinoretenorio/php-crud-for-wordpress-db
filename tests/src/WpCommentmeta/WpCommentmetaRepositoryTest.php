<?php

declare(strict_types=1);

namespace WordPress\Tests\WpCommentmeta;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpCommentmeta\{ WpCommentmetaDto, IWpCommentmetaRepository, WpCommentmetaRepository };

class WpCommentmetaRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpCommentmetaDto $dto;
    private IWpCommentmetaRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "meta_id" => 8520,
            "comment_id" => 2191,
            "meta_key" => "morning",
            "meta_value" => "Popular establish those staff father even. Goal interest until call center small write. Majority three edge body.",
        ];
        $this->dto = new WpCommentmetaDto($this->input);
        $this->repository = new WpCommentmetaRepository($this->db);
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
        $expected = 571;

        $sql = "INSERT INTO `wp_commentmeta` (`comment_id`, `meta_key`, `meta_value`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->commentId,
                $this->dto->metaKey,
                $this->dto->metaValue
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
        $expected = 6747;

        $sql = "UPDATE `wp_commentmeta` SET `comment_id` = ?, `meta_key` = ?, `meta_value` = ?
                WHERE `meta_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->commentId,
                $this->dto->metaKey,
                $this->dto->metaValue,
                $this->dto->metaId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $metaId = 4851;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($metaId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $metaId = 237;

        $sql = "SELECT `meta_id`, `comment_id`, `meta_key`, `meta_value`
                FROM `wp_commentmeta` WHERE `meta_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$metaId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($metaId);
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
        $sql = "SELECT `meta_id`, `comment_id`, `meta_key`, `meta_value`
                FROM `wp_commentmeta`";

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
        $metaId = 7034;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($metaId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $metaId = 2717;
        $expected = 7644;

        $sql = "DELETE FROM `wp_commentmeta` WHERE `meta_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$metaId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($metaId);
        $this->assertEquals($expected, $actual);
    }
}
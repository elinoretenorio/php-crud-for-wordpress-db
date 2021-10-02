<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermmeta;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpTermmeta\{ WpTermmetaDto, IWpTermmetaRepository, WpTermmetaRepository };

class WpTermmetaRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpTermmetaDto $dto;
    private IWpTermmetaRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "meta_id" => 7103,
            "term_id" => 6572,
            "meta_key" => "arm",
            "meta_value" => "Safe truth play author field analysis. Sign smile entire energy during.",
        ];
        $this->dto = new WpTermmetaDto($this->input);
        $this->repository = new WpTermmetaRepository($this->db);
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
        $expected = 7297;

        $sql = "INSERT INTO `wp_termmeta` (`term_id`, `meta_key`, `meta_value`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->termId,
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
        $expected = 2856;

        $sql = "UPDATE `wp_termmeta` SET `term_id` = ?, `meta_key` = ?, `meta_value` = ?
                WHERE `meta_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->termId,
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
        $metaId = 6544;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($metaId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $metaId = 4456;

        $sql = "SELECT `meta_id`, `term_id`, `meta_key`, `meta_value`
                FROM `wp_termmeta` WHERE `meta_id` = ?";

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
        $sql = "SELECT `meta_id`, `term_id`, `meta_key`, `meta_value`
                FROM `wp_termmeta`";

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
        $metaId = 116;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($metaId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $metaId = 5683;
        $expected = 5847;

        $sql = "DELETE FROM `wp_termmeta` WHERE `meta_id` = ?";

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
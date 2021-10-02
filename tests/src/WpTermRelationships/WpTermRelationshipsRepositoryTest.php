<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermRelationships;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpTermRelationships\{ WpTermRelationshipsDto, IWpTermRelationshipsRepository, WpTermRelationshipsRepository };

class WpTermRelationshipsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpTermRelationshipsDto $dto;
    private IWpTermRelationshipsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "object_id" => 107,
            "term_taxonomy_id" => 6633,
            "term_order" => 3255,
        ];
        $this->dto = new WpTermRelationshipsDto($this->input);
        $this->repository = new WpTermRelationshipsRepository($this->db);
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
        $expected = 2216;

        $sql = "INSERT INTO `wp_term_relationships` (`term_taxonomy_id`, `term_order`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->termTaxonomyId,
                $this->dto->termOrder
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
        $expected = 7594;

        $sql = "UPDATE `wp_term_relationships` SET `term_taxonomy_id` = ?, `term_order` = ?
                WHERE `object_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->termTaxonomyId,
                $this->dto->termOrder,
                $this->dto->objectId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $objectId = 6913;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($objectId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $objectId = 7075;

        $sql = "SELECT `object_id`, `term_taxonomy_id`, `term_order`
                FROM `wp_term_relationships` WHERE `object_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$objectId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($objectId);
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
        $sql = "SELECT `object_id`, `term_taxonomy_id`, `term_order`
                FROM `wp_term_relationships`";

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
        $objectId = 8712;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($objectId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $objectId = 8218;
        $expected = 1959;

        $sql = "DELETE FROM `wp_term_relationships` WHERE `object_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$objectId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($objectId);
        $this->assertEquals($expected, $actual);
    }
}
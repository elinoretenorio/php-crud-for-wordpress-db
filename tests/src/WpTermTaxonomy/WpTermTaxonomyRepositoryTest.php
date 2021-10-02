<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermTaxonomy;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpTermTaxonomy\{ WpTermTaxonomyDto, IWpTermTaxonomyRepository, WpTermTaxonomyRepository };

class WpTermTaxonomyRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpTermTaxonomyDto $dto;
    private IWpTermTaxonomyRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "term_taxonomy_id" => 4964,
            "term_id" => 6289,
            "taxonomy" => "believe",
            "description" => "Order design sit present use only dark.",
            "parent" => 1319,
            "count" => 2611,
        ];
        $this->dto = new WpTermTaxonomyDto($this->input);
        $this->repository = new WpTermTaxonomyRepository($this->db);
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
        $expected = 9743;

        $sql = "INSERT INTO `wp_term_taxonomy` (`term_id`, `taxonomy`, `description`, `parent`, `count`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->termId,
                $this->dto->taxonomy,
                $this->dto->description,
                $this->dto->parent,
                $this->dto->count
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
        $expected = 3922;

        $sql = "UPDATE `wp_term_taxonomy` SET `term_id` = ?, `taxonomy` = ?, `description` = ?, `parent` = ?, `count` = ?
                WHERE `term_taxonomy_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->termId,
                $this->dto->taxonomy,
                $this->dto->description,
                $this->dto->parent,
                $this->dto->count,
                $this->dto->termTaxonomyId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $termTaxonomyId = 4630;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($termTaxonomyId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $termTaxonomyId = 9369;

        $sql = "SELECT `term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`
                FROM `wp_term_taxonomy` WHERE `term_taxonomy_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$termTaxonomyId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($termTaxonomyId);
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
        $sql = "SELECT `term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`
                FROM `wp_term_taxonomy`";

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
        $termTaxonomyId = 370;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($termTaxonomyId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $termTaxonomyId = 7698;
        $expected = 7242;

        $sql = "DELETE FROM `wp_term_taxonomy` WHERE `term_taxonomy_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$termTaxonomyId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($termTaxonomyId);
        $this->assertEquals($expected, $actual);
    }
}
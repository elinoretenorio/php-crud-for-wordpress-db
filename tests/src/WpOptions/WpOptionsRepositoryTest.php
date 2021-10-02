<?php

declare(strict_types=1);

namespace WordPress\Tests\WpOptions;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpOptions\{ WpOptionsDto, IWpOptionsRepository, WpOptionsRepository };

class WpOptionsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpOptionsDto $dto;
    private IWpOptionsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "option_id" => 7362,
            "option_name" => "one",
            "option_value" => "Movement film time consumer including word. Care kind now star.",
            "autoload" => "road",
        ];
        $this->dto = new WpOptionsDto($this->input);
        $this->repository = new WpOptionsRepository($this->db);
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
        $expected = 7530;

        $sql = "INSERT INTO `wp_options` (`option_name`, `option_value`, `autoload`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->optionName,
                $this->dto->optionValue,
                $this->dto->autoload
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
        $expected = 1545;

        $sql = "UPDATE `wp_options` SET `option_name` = ?, `option_value` = ?, `autoload` = ?
                WHERE `option_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->optionName,
                $this->dto->optionValue,
                $this->dto->autoload,
                $this->dto->optionId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $optionId = 814;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($optionId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $optionId = 8379;

        $sql = "SELECT `option_id`, `option_name`, `option_value`, `autoload`
                FROM `wp_options` WHERE `option_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$optionId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($optionId);
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
        $sql = "SELECT `option_id`, `option_name`, `option_value`, `autoload`
                FROM `wp_options`";

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
        $optionId = 2459;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($optionId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $optionId = 2240;
        $expected = 3960;

        $sql = "DELETE FROM `wp_options` WHERE `option_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$optionId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($optionId);
        $this->assertEquals($expected, $actual);
    }
}
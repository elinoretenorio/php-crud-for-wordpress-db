<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermRelationships;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermRelationships\{ WpTermRelationshipsDto, WpTermRelationshipsModel, IWpTermRelationshipsService, WpTermRelationshipsService };

class WpTermRelationshipsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpTermRelationshipsDto $dto;
    private WpTermRelationshipsModel $model;
    private IWpTermRelationshipsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpTermRelationships\IWpTermRelationshipsRepository");
        $this->input = [
            "object_id" => 5469,
            "term_taxonomy_id" => 9370,
            "term_order" => 7013,
        ];
        $this->dto = new WpTermRelationshipsDto($this->input);
        $this->model = new WpTermRelationshipsModel($this->dto);
        $this->service = new WpTermRelationshipsService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 6890;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 1539;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $objectId = 9242;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($objectId)
            ->willReturn(null);

        $actual = $this->service->get($objectId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $objectId = 9140;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($objectId)
            ->willReturn($this->dto);

        $actual = $this->service->get($objectId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $objectId = 7556;
        $expected = 5496;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($objectId)
            ->willReturn($expected);

        $actual = $this->service->delete($objectId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}
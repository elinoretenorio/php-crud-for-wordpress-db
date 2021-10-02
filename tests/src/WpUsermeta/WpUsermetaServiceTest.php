<?php

declare(strict_types=1);

namespace WordPress\Tests\WpUsermeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpUsermeta\{ WpUsermetaDto, WpUsermetaModel, IWpUsermetaService, WpUsermetaService };

class WpUsermetaServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpUsermetaDto $dto;
    private WpUsermetaModel $model;
    private IWpUsermetaService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpUsermeta\IWpUsermetaRepository");
        $this->input = [
            "umeta_id" => 8805,
            "user_id" => 1232,
            "meta_key" => "quality",
            "meta_value" => "Home look simply none our reduce much. Yet nothing majority thing. Hospital red suggest financial policy remain shoulder.",
        ];
        $this->dto = new WpUsermetaDto($this->input);
        $this->model = new WpUsermetaModel($this->dto);
        $this->service = new WpUsermetaService($this->repository);
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
        $expected = 7777;

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
        $expected = 2143;

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
        $umetaId = 4280;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($umetaId)
            ->willReturn(null);

        $actual = $this->service->get($umetaId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $umetaId = 2524;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($umetaId)
            ->willReturn($this->dto);

        $actual = $this->service->get($umetaId);
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
        $umetaId = 6736;
        $expected = 8888;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($umetaId)
            ->willReturn($expected);

        $actual = $this->service->delete($umetaId);
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
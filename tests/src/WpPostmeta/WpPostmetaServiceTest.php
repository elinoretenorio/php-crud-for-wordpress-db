<?php

declare(strict_types=1);

namespace WordPress\Tests\WpPostmeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpPostmeta\{ WpPostmetaDto, WpPostmetaModel, IWpPostmetaService, WpPostmetaService };

class WpPostmetaServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpPostmetaDto $dto;
    private WpPostmetaModel $model;
    private IWpPostmetaService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpPostmeta\IWpPostmetaRepository");
        $this->input = [
            "meta_id" => 2268,
            "post_id" => 2062,
            "meta_key" => "design",
            "meta_value" => "Ever task maintain clear recently. Clear standard use try.",
        ];
        $this->dto = new WpPostmetaDto($this->input);
        $this->model = new WpPostmetaModel($this->dto);
        $this->service = new WpPostmetaService($this->repository);
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
        $expected = 9825;

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
        $expected = 2030;

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
        $metaId = 4317;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($metaId)
            ->willReturn(null);

        $actual = $this->service->get($metaId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $metaId = 7463;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($metaId)
            ->willReturn($this->dto);

        $actual = $this->service->get($metaId);
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
        $metaId = 678;
        $expected = 1620;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($metaId)
            ->willReturn($expected);

        $actual = $this->service->delete($metaId);
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
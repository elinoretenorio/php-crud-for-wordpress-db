<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermmeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermmeta\{ WpTermmetaDto, WpTermmetaModel, IWpTermmetaService, WpTermmetaService };

class WpTermmetaServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpTermmetaDto $dto;
    private WpTermmetaModel $model;
    private IWpTermmetaService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpTermmeta\IWpTermmetaRepository");
        $this->input = [
            "meta_id" => 8486,
            "term_id" => 3152,
            "meta_key" => "police",
            "meta_value" => "Audience else money. Movie effect together.",
        ];
        $this->dto = new WpTermmetaDto($this->input);
        $this->model = new WpTermmetaModel($this->dto);
        $this->service = new WpTermmetaService($this->repository);
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
        $expected = 7392;

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
        $expected = 7724;

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
        $metaId = 4722;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($metaId)
            ->willReturn(null);

        $actual = $this->service->get($metaId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $metaId = 2158;

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
        $metaId = 9044;
        $expected = 248;

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
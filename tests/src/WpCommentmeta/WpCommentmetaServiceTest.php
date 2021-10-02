<?php

declare(strict_types=1);

namespace WordPress\Tests\WpCommentmeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpCommentmeta\{ WpCommentmetaDto, WpCommentmetaModel, IWpCommentmetaService, WpCommentmetaService };

class WpCommentmetaServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpCommentmetaDto $dto;
    private WpCommentmetaModel $model;
    private IWpCommentmetaService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpCommentmeta\IWpCommentmetaRepository");
        $this->input = [
            "meta_id" => 2705,
            "comment_id" => 3625,
            "meta_key" => "each",
            "meta_value" => "Statement apply beautiful listen enjoy culture. Political some majority. Along drug network its newspaper.",
        ];
        $this->dto = new WpCommentmetaDto($this->input);
        $this->model = new WpCommentmetaModel($this->dto);
        $this->service = new WpCommentmetaService($this->repository);
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
        $expected = 7214;

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
        $expected = 2135;

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
        $metaId = 7842;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($metaId)
            ->willReturn(null);

        $actual = $this->service->get($metaId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $metaId = 4497;

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
        $metaId = 5056;
        $expected = 9442;

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
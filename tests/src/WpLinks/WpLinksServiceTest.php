<?php

declare(strict_types=1);

namespace WordPress\Tests\WpLinks;

use PHPUnit\Framework\TestCase;
use WordPress\WpLinks\{ WpLinksDto, WpLinksModel, IWpLinksService, WpLinksService };

class WpLinksServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpLinksDto $dto;
    private WpLinksModel $model;
    private IWpLinksService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpLinks\IWpLinksRepository");
        $this->input = [
            "link_id" => 4445,
            "link_url" => "professional",
            "link_name" => "participant",
            "link_image" => "use",
            "link_target" => "heart",
            "link_description" => "board",
            "link_visible" => "view",
            "link_owner" => 2560,
            "link_rating" => 8122,
            "link_updated" => "2021-10-11 10:03:18",
            "link_rel" => "early",
            "link_notes" => "Industry tend level effort people party green. Reality performance free story. Oil close ground safe sit war question resource.",
            "link_rss" => "certainly",
        ];
        $this->dto = new WpLinksDto($this->input);
        $this->model = new WpLinksModel($this->dto);
        $this->service = new WpLinksService($this->repository);
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
        $expected = 5776;

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
        $expected = 8576;

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
        $linkId = 2799;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($linkId)
            ->willReturn(null);

        $actual = $this->service->get($linkId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $linkId = 4737;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($linkId)
            ->willReturn($this->dto);

        $actual = $this->service->get($linkId);
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
        $linkId = 9945;
        $expected = 4882;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($linkId)
            ->willReturn($expected);

        $actual = $this->service->delete($linkId);
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
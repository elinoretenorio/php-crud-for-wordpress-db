<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTerms;

use PHPUnit\Framework\TestCase;
use WordPress\WpTerms\{ WpTermsDto, WpTermsModel, IWpTermsService, WpTermsService };

class WpTermsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpTermsDto $dto;
    private WpTermsModel $model;
    private IWpTermsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpTerms\IWpTermsRepository");
        $this->input = [
            "term_id" => 3747,
            "name" => "issue",
            "slug" => "side",
            "term_group" => 654,
        ];
        $this->dto = new WpTermsDto($this->input);
        $this->model = new WpTermsModel($this->dto);
        $this->service = new WpTermsService($this->repository);
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
        $expected = 3851;

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
        $expected = 8561;

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
        $termId = 9529;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($termId)
            ->willReturn(null);

        $actual = $this->service->get($termId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $termId = 3784;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($termId)
            ->willReturn($this->dto);

        $actual = $this->service->get($termId);
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
        $termId = 4163;
        $expected = 3874;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($termId)
            ->willReturn($expected);

        $actual = $this->service->delete($termId);
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
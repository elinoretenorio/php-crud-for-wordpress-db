<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermTaxonomy;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermTaxonomy\{ WpTermTaxonomyDto, WpTermTaxonomyModel, IWpTermTaxonomyService, WpTermTaxonomyService };

class WpTermTaxonomyServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpTermTaxonomyDto $dto;
    private WpTermTaxonomyModel $model;
    private IWpTermTaxonomyService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpTermTaxonomy\IWpTermTaxonomyRepository");
        $this->input = [
            "term_taxonomy_id" => 8259,
            "term_id" => 9209,
            "taxonomy" => "pull",
            "description" => "Place reality sell happy experience factor. Area cut whole total Mrs all heart first. Example population attention best dark.",
            "parent" => 1288,
            "count" => 5113,
        ];
        $this->dto = new WpTermTaxonomyDto($this->input);
        $this->model = new WpTermTaxonomyModel($this->dto);
        $this->service = new WpTermTaxonomyService($this->repository);
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
        $expected = 4867;

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
        $expected = 5237;

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
        $termTaxonomyId = 8006;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($termTaxonomyId)
            ->willReturn(null);

        $actual = $this->service->get($termTaxonomyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $termTaxonomyId = 4601;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($termTaxonomyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($termTaxonomyId);
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
        $termTaxonomyId = 5582;
        $expected = 8041;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($termTaxonomyId)
            ->willReturn($expected);

        $actual = $this->service->delete($termTaxonomyId);
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
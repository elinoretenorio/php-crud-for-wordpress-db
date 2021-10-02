<?php

declare(strict_types=1);

namespace WordPress\Tests\WpOptions;

use PHPUnit\Framework\TestCase;
use WordPress\WpOptions\{ WpOptionsDto, WpOptionsModel, IWpOptionsService, WpOptionsService };

class WpOptionsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpOptionsDto $dto;
    private WpOptionsModel $model;
    private IWpOptionsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpOptions\IWpOptionsRepository");
        $this->input = [
            "option_id" => 748,
            "option_name" => "indicate",
            "option_value" => "Take account two although point true. Alone kitchen wrong key similar may. During vote front.",
            "autoload" => "while",
        ];
        $this->dto = new WpOptionsDto($this->input);
        $this->model = new WpOptionsModel($this->dto);
        $this->service = new WpOptionsService($this->repository);
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
        $expected = 3779;

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
        $expected = 7237;

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
        $optionId = 6646;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($optionId)
            ->willReturn(null);

        $actual = $this->service->get($optionId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $optionId = 8693;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($optionId)
            ->willReturn($this->dto);

        $actual = $this->service->get($optionId);
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
        $optionId = 7388;
        $expected = 8224;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($optionId)
            ->willReturn($expected);

        $actual = $this->service->delete($optionId);
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
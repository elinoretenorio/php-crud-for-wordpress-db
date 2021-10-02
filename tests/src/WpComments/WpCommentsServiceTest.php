<?php

declare(strict_types=1);

namespace WordPress\Tests\WpComments;

use PHPUnit\Framework\TestCase;
use WordPress\WpComments\{ WpCommentsDto, WpCommentsModel, IWpCommentsService, WpCommentsService };

class WpCommentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpCommentsDto $dto;
    private WpCommentsModel $model;
    private IWpCommentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpComments\IWpCommentsRepository");
        $this->input = [
            "comment_ID" => 9383,
            "comment_post_ID" => 7759,
            "comment_author" => "Less believe ability buy family condition.",
            "comment_author_email" => "joel35@example.com",
            "comment_author_url" => "our",
            "comment_author_IP" => "like",
            "comment_date" => "2021-09-25 03:51:42",
            "comment_date_gmt" => "2021-10-11 15:22:20",
            "comment_content" => "Heart father say. First argue training continue. Support type TV listen media.",
            "comment_karma" => 473,
            "comment_approved" => "hit",
            "comment_agent" => "my",
            "comment_type" => "attention",
            "comment_parent" => 9070,
            "user_id" => 8264,
        ];
        $this->dto = new WpCommentsDto($this->input);
        $this->model = new WpCommentsModel($this->dto);
        $this->service = new WpCommentsService($this->repository);
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
        $expected = 2613;

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
        $expected = 2812;

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
        $commentId = 591;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($commentId)
            ->willReturn(null);

        $actual = $this->service->get($commentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $commentId = 1210;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($commentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($commentId);
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
        $commentId = 8342;
        $expected = 6543;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($commentId)
            ->willReturn($expected);

        $actual = $this->service->delete($commentId);
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
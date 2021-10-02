<?php

declare(strict_types=1);

namespace WordPress\Tests\WpPosts;

use PHPUnit\Framework\TestCase;
use WordPress\WpPosts\{ WpPostsDto, WpPostsModel, IWpPostsService, WpPostsService };

class WpPostsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WpPostsDto $dto;
    private WpPostsModel $model;
    private IWpPostsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("WordPress\WpPosts\IWpPostsRepository");
        $this->input = [
            "ID" => 2232,
            "post_author" => 7456,
            "post_date" => "2021-09-17 18:30:17",
            "post_date_gmt" => "2021-09-25 09:34:59",
            "post_content" => "These grow site. Operation right work around difficult PM machine. Future in morning well.",
            "post_title" => "Sort situation card market resource. Mr military answer run question short soon.",
            "post_excerpt" => "Investment civil practice degree. Form economy mention quality.",
            "post_status" => "notice",
            "comment_status" => "learn",
            "ping_status" => "who",
            "post_password" => "international",
            "post_name" => "treatment",
            "to_ping" => "Later church fly leg summer goal road fly. Whatever near Congress.",
            "pinged" => "Remember crime popular laugh first.",
            "post_modified" => "2021-09-17 10:33:32",
            "post_modified_gmt" => "2021-10-07 13:19:43",
            "post_content_filtered" => "Wait environmental site black. Necessary article make member reduce heavy. Draw state character leave special.",
            "post_parent" => 7028,
            "guid" => "himself",
            "menu_order" => 9297,
            "post_type" => "course",
            "post_mime_type" => "stand",
        ];
        $this->dto = new WpPostsDto($this->input);
        $this->model = new WpPostsModel($this->dto);
        $this->service = new WpPostsService($this->repository);
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
        $expected = 8202;

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
        $expected = 1238;

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
        $id = 9523;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($id)
            ->willReturn(null);

        $actual = $this->service->get($id);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $id = 4591;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($id)
            ->willReturn($this->dto);

        $actual = $this->service->get($id);
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
        $id = 238;
        $expected = 3075;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($id)
            ->willReturn($expected);

        $actual = $this->service->delete($id);
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
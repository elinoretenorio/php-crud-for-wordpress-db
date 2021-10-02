<?php

declare(strict_types=1);

namespace WordPress\Tests\WpPosts;

use PHPUnit\Framework\TestCase;
use WordPress\WpPosts\{ WpPostsDto, WpPostsModel, WpPostsController };

class WpPostsControllerTest extends TestCase
{
    private array $input;
    private WpPostsDto $dto;
    private WpPostsModel $model;
    private $service;
    private $request;
    private $stream;
    private WpPostsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "ID" => 7315,
            "post_author" => 8263,
            "post_date" => "2021-10-08 14:34:49",
            "post_date_gmt" => "2021-09-22 15:24:56",
            "post_content" => "Guess through region change. Worry likely by after course enter. However imagine executive line control record.",
            "post_title" => "Eye world let control foot. Individual consumer degree worker.",
            "post_excerpt" => "To instead late base general. Reason west list improve investment return. Stage production edge television stand stop including. Part draw agency those little maintain full.",
            "post_status" => "know",
            "comment_status" => "respond",
            "ping_status" => "ten",
            "post_password" => "let",
            "post_name" => "worry",
            "to_ping" => "Leg artist see reduce fast loss. Country white model training. Raise star box back community.",
            "pinged" => "Also near someone example green second store.",
            "post_modified" => "2021-10-12 06:38:47",
            "post_modified_gmt" => "2021-09-26 16:17:30",
            "post_content_filtered" => "Pattern power many or. Our film seem half most science.",
            "post_parent" => 2954,
            "guid" => "past",
            "menu_order" => 2546,
            "post_type" => "perhaps",
            "post_mime_type" => "billion",
        ];
        $this->dto = new WpPostsDto($this->input);
        $this->model = new WpPostsModel($this->dto);
        $this->service = $this->createMock("WordPress\WpPosts\IWpPostsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new WpPostsController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 5311;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["ID" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 2668;
        $expected = ["result" => $id];
        $args = ["ID" => 2550];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["ID" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["ID" => 3544];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["ID"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["ID" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 5817;
        $expected = ["result" => $id];
        $args = ["ID" => 6770];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["ID"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}
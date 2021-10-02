<?php

declare(strict_types=1);

namespace WordPress\Tests\WpComments;

use PHPUnit\Framework\TestCase;
use WordPress\WpComments\{ WpCommentsDto, WpCommentsModel, WpCommentsController };

class WpCommentsControllerTest extends TestCase
{
    private array $input;
    private WpCommentsDto $dto;
    private WpCommentsModel $model;
    private $service;
    private $request;
    private $stream;
    private WpCommentsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "comment_ID" => 2928,
            "comment_post_ID" => 8048,
            "comment_author" => "Election TV science attention market choice again into.",
            "comment_author_email" => "nicholas50@example.com",
            "comment_author_url" => "onto",
            "comment_author_IP" => "charge",
            "comment_date" => "2021-10-11 14:36:29",
            "comment_date_gmt" => "2021-09-30 13:13:58",
            "comment_content" => "Have bar cut half before any. Remain government others number weight become.",
            "comment_karma" => 9324,
            "comment_approved" => "dark",
            "comment_agent" => "since",
            "comment_type" => "what",
            "comment_parent" => 8619,
            "user_id" => 8391,
        ];
        $this->dto = new WpCommentsDto($this->input);
        $this->model = new WpCommentsModel($this->dto);
        $this->service = $this->createMock("WordPress\WpComments\IWpCommentsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new WpCommentsController(
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
        $id = 6616;
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
        $args = ["comment_ID" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 1350;
        $expected = ["result" => $id];
        $args = ["comment_ID" => 1611];

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
        $args = ["comment_ID" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["comment_ID" => 5875];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["comment_ID"])
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
        $args = ["comment_ID" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 8565;
        $expected = ["result" => $id];
        $args = ["comment_ID" => 3766];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["comment_ID"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}
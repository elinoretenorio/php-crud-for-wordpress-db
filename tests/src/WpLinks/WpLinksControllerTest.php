<?php

declare(strict_types=1);

namespace WordPress\Tests\WpLinks;

use PHPUnit\Framework\TestCase;
use WordPress\WpLinks\{ WpLinksDto, WpLinksModel, WpLinksController };

class WpLinksControllerTest extends TestCase
{
    private array $input;
    private WpLinksDto $dto;
    private WpLinksModel $model;
    private $service;
    private $request;
    private $stream;
    private WpLinksController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "link_id" => 4089,
            "link_url" => "receive",
            "link_name" => "wrong",
            "link_image" => "rise",
            "link_target" => "name",
            "link_description" => "economic",
            "link_visible" => "realize",
            "link_owner" => 8747,
            "link_rating" => 9232,
            "link_updated" => "2021-09-18 15:01:31",
            "link_rel" => "simple",
            "link_notes" => "To rate or door order left police institution. Detail sound country early either international time. Growth claim institution card them. Draw need hour.",
            "link_rss" => "sea",
        ];
        $this->dto = new WpLinksDto($this->input);
        $this->model = new WpLinksModel($this->dto);
        $this->service = $this->createMock("WordPress\WpLinks\IWpLinksService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new WpLinksController(
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
        $id = 1423;
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
        $args = ["link_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 2668;
        $expected = ["result" => $id];
        $args = ["link_id" => 6499];

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
        $args = ["link_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["link_id" => 5489];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["link_id"])
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
        $args = ["link_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 2822;
        $expected = ["result" => $id];
        $args = ["link_id" => 5421];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["link_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}
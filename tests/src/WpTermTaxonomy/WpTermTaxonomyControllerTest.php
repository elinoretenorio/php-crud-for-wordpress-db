<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermTaxonomy;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermTaxonomy\{ WpTermTaxonomyDto, WpTermTaxonomyModel, WpTermTaxonomyController };

class WpTermTaxonomyControllerTest extends TestCase
{
    private array $input;
    private WpTermTaxonomyDto $dto;
    private WpTermTaxonomyModel $model;
    private $service;
    private $request;
    private $stream;
    private WpTermTaxonomyController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "term_taxonomy_id" => 3230,
            "term_id" => 8247,
            "taxonomy" => "who",
            "description" => "Service will reflect nearly important beautiful. Cultural protect face field method like. Run pretty quality. Reality sound blood sometimes billion remain detail.",
            "parent" => 5656,
            "count" => 3678,
        ];
        $this->dto = new WpTermTaxonomyDto($this->input);
        $this->model = new WpTermTaxonomyModel($this->dto);
        $this->service = $this->createMock("WordPress\WpTermTaxonomy\IWpTermTaxonomyService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new WpTermTaxonomyController(
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
        $id = 467;
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
        $args = ["term_taxonomy_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 1784;
        $expected = ["result" => $id];
        $args = ["term_taxonomy_id" => 9933];

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
        $args = ["term_taxonomy_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["term_taxonomy_id" => 5210];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["term_taxonomy_id"])
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
        $args = ["term_taxonomy_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 3691;
        $expected = ["result" => $id];
        $args = ["term_taxonomy_id" => 2339];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["term_taxonomy_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}
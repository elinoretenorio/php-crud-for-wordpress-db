<?php

declare(strict_types=1);

namespace WordPress\Tests\WpPostmeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpPostmeta\{ WpPostmetaDto, WpPostmetaModel };

class WpPostmetaModelTest extends TestCase
{
    private array $input;
    private WpPostmetaDto $dto;
    private WpPostmetaModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "meta_id" => 3469,
            "post_id" => 8641,
            "meta_key" => "those",
            "meta_value" => "Price maybe finish let. First commercial set cost reality.",
        ];
        $this->dto = new WpPostmetaDto($this->input);
        $this->model = new WpPostmetaModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpPostmetaModel(null);

        $this->assertInstanceOf(WpPostmetaModel::class, $model);
    }

    public function testGetMetaId(): void
    {
        $this->assertEquals($this->dto->metaId, $this->model->getMetaId());
    }

    public function testSetMetaId(): void
    {
        $expected = 6794;
        $model = $this->model;
        $model->setMetaId($expected);

        $this->assertEquals($expected, $model->getMetaId());
    }

    public function testGetPostId(): void
    {
        $this->assertEquals($this->dto->postId, $this->model->getPostId());
    }

    public function testSetPostId(): void
    {
        $expected = 4437;
        $model = $this->model;
        $model->setPostId($expected);

        $this->assertEquals($expected, $model->getPostId());
    }

    public function testGetMetaKey(): void
    {
        $this->assertEquals($this->dto->metaKey, $this->model->getMetaKey());
    }

    public function testSetMetaKey(): void
    {
        $expected = "long";
        $model = $this->model;
        $model->setMetaKey($expected);

        $this->assertEquals($expected, $model->getMetaKey());
    }

    public function testGetMetaValue(): void
    {
        $this->assertEquals($this->dto->metaValue, $this->model->getMetaValue());
    }

    public function testSetMetaValue(): void
    {
        $expected = "Book nation other short. Throughout return forget ago individual carry industry. Opportunity fund practice structure top as data.";
        $model = $this->model;
        $model->setMetaValue($expected);

        $this->assertEquals($expected, $model->getMetaValue());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}
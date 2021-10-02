<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermmeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermmeta\{ WpTermmetaDto, WpTermmetaModel };

class WpTermmetaModelTest extends TestCase
{
    private array $input;
    private WpTermmetaDto $dto;
    private WpTermmetaModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "meta_id" => 388,
            "term_id" => 5210,
            "meta_key" => "ground",
            "meta_value" => "Debate watch else others. Heavy same successful get there list.",
        ];
        $this->dto = new WpTermmetaDto($this->input);
        $this->model = new WpTermmetaModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpTermmetaModel(null);

        $this->assertInstanceOf(WpTermmetaModel::class, $model);
    }

    public function testGetMetaId(): void
    {
        $this->assertEquals($this->dto->metaId, $this->model->getMetaId());
    }

    public function testSetMetaId(): void
    {
        $expected = 8356;
        $model = $this->model;
        $model->setMetaId($expected);

        $this->assertEquals($expected, $model->getMetaId());
    }

    public function testGetTermId(): void
    {
        $this->assertEquals($this->dto->termId, $this->model->getTermId());
    }

    public function testSetTermId(): void
    {
        $expected = 1994;
        $model = $this->model;
        $model->setTermId($expected);

        $this->assertEquals($expected, $model->getTermId());
    }

    public function testGetMetaKey(): void
    {
        $this->assertEquals($this->dto->metaKey, $this->model->getMetaKey());
    }

    public function testSetMetaKey(): void
    {
        $expected = "book";
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
        $expected = "Have trade wish dog. Cold may challenge travel third television. Environment receive any hold specific few.";
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
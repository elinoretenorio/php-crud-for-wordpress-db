<?php

declare(strict_types=1);

namespace WordPress\Tests\WpUsermeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpUsermeta\{ WpUsermetaDto, WpUsermetaModel };

class WpUsermetaModelTest extends TestCase
{
    private array $input;
    private WpUsermetaDto $dto;
    private WpUsermetaModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "umeta_id" => 4634,
            "user_id" => 7477,
            "meta_key" => "type",
            "meta_value" => "Forward skin these democratic. Institution case young set coach.",
        ];
        $this->dto = new WpUsermetaDto($this->input);
        $this->model = new WpUsermetaModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpUsermetaModel(null);

        $this->assertInstanceOf(WpUsermetaModel::class, $model);
    }

    public function testGetUmetaId(): void
    {
        $this->assertEquals($this->dto->umetaId, $this->model->getUmetaId());
    }

    public function testSetUmetaId(): void
    {
        $expected = 5075;
        $model = $this->model;
        $model->setUmetaId($expected);

        $this->assertEquals($expected, $model->getUmetaId());
    }

    public function testGetUserId(): void
    {
        $this->assertEquals($this->dto->userId, $this->model->getUserId());
    }

    public function testSetUserId(): void
    {
        $expected = 8147;
        $model = $this->model;
        $model->setUserId($expected);

        $this->assertEquals($expected, $model->getUserId());
    }

    public function testGetMetaKey(): void
    {
        $this->assertEquals($this->dto->metaKey, $this->model->getMetaKey());
    }

    public function testSetMetaKey(): void
    {
        $expected = "prove";
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
        $expected = "Final study prevent majority. Arm cell already learn evidence. Follow thing century choose which.";
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
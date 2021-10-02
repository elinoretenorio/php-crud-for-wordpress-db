<?php

declare(strict_types=1);

namespace WordPress\Tests\WpOptions;

use PHPUnit\Framework\TestCase;
use WordPress\WpOptions\{ WpOptionsDto, WpOptionsModel };

class WpOptionsModelTest extends TestCase
{
    private array $input;
    private WpOptionsDto $dto;
    private WpOptionsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "option_id" => 6623,
            "option_name" => "ground",
            "option_value" => "Scene very such think be system. Character best we.",
            "autoload" => "result",
        ];
        $this->dto = new WpOptionsDto($this->input);
        $this->model = new WpOptionsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpOptionsModel(null);

        $this->assertInstanceOf(WpOptionsModel::class, $model);
    }

    public function testGetOptionId(): void
    {
        $this->assertEquals($this->dto->optionId, $this->model->getOptionId());
    }

    public function testSetOptionId(): void
    {
        $expected = 4363;
        $model = $this->model;
        $model->setOptionId($expected);

        $this->assertEquals($expected, $model->getOptionId());
    }

    public function testGetOptionName(): void
    {
        $this->assertEquals($this->dto->optionName, $this->model->getOptionName());
    }

    public function testSetOptionName(): void
    {
        $expected = "soldier";
        $model = $this->model;
        $model->setOptionName($expected);

        $this->assertEquals($expected, $model->getOptionName());
    }

    public function testGetOptionValue(): void
    {
        $this->assertEquals($this->dto->optionValue, $this->model->getOptionValue());
    }

    public function testSetOptionValue(): void
    {
        $expected = "Security side plant education. However first yourself describe both. Note ground machine outside open unit forget.";
        $model = $this->model;
        $model->setOptionValue($expected);

        $this->assertEquals($expected, $model->getOptionValue());
    }

    public function testGetAutoload(): void
    {
        $this->assertEquals($this->dto->autoload, $this->model->getAutoload());
    }

    public function testSetAutoload(): void
    {
        $expected = "though";
        $model = $this->model;
        $model->setAutoload($expected);

        $this->assertEquals($expected, $model->getAutoload());
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
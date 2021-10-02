<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTerms;

use PHPUnit\Framework\TestCase;
use WordPress\WpTerms\{ WpTermsDto, WpTermsModel };

class WpTermsModelTest extends TestCase
{
    private array $input;
    private WpTermsDto $dto;
    private WpTermsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "term_id" => 9028,
            "name" => "letter",
            "slug" => "kitchen",
            "term_group" => 4039,
        ];
        $this->dto = new WpTermsDto($this->input);
        $this->model = new WpTermsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpTermsModel(null);

        $this->assertInstanceOf(WpTermsModel::class, $model);
    }

    public function testGetTermId(): void
    {
        $this->assertEquals($this->dto->termId, $this->model->getTermId());
    }

    public function testSetTermId(): void
    {
        $expected = 3316;
        $model = $this->model;
        $model->setTermId($expected);

        $this->assertEquals($expected, $model->getTermId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "court";
        $model = $this->model;
        $model->setName($expected);

        $this->assertEquals($expected, $model->getName());
    }

    public function testGetSlug(): void
    {
        $this->assertEquals($this->dto->slug, $this->model->getSlug());
    }

    public function testSetSlug(): void
    {
        $expected = "bit";
        $model = $this->model;
        $model->setSlug($expected);

        $this->assertEquals($expected, $model->getSlug());
    }

    public function testGetTermGroup(): void
    {
        $this->assertEquals($this->dto->termGroup, $this->model->getTermGroup());
    }

    public function testSetTermGroup(): void
    {
        $expected = 5387;
        $model = $this->model;
        $model->setTermGroup($expected);

        $this->assertEquals($expected, $model->getTermGroup());
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
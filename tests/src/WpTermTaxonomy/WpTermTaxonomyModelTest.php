<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermTaxonomy;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermTaxonomy\{ WpTermTaxonomyDto, WpTermTaxonomyModel };

class WpTermTaxonomyModelTest extends TestCase
{
    private array $input;
    private WpTermTaxonomyDto $dto;
    private WpTermTaxonomyModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "term_taxonomy_id" => 1710,
            "term_id" => 8973,
            "taxonomy" => "choose",
            "description" => "Employee beautiful first you. Scientist option technology. Share decide fall.",
            "parent" => 5432,
            "count" => 1177,
        ];
        $this->dto = new WpTermTaxonomyDto($this->input);
        $this->model = new WpTermTaxonomyModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpTermTaxonomyModel(null);

        $this->assertInstanceOf(WpTermTaxonomyModel::class, $model);
    }

    public function testGetTermTaxonomyId(): void
    {
        $this->assertEquals($this->dto->termTaxonomyId, $this->model->getTermTaxonomyId());
    }

    public function testSetTermTaxonomyId(): void
    {
        $expected = 9416;
        $model = $this->model;
        $model->setTermTaxonomyId($expected);

        $this->assertEquals($expected, $model->getTermTaxonomyId());
    }

    public function testGetTermId(): void
    {
        $this->assertEquals($this->dto->termId, $this->model->getTermId());
    }

    public function testSetTermId(): void
    {
        $expected = 9739;
        $model = $this->model;
        $model->setTermId($expected);

        $this->assertEquals($expected, $model->getTermId());
    }

    public function testGetTaxonomy(): void
    {
        $this->assertEquals($this->dto->taxonomy, $this->model->getTaxonomy());
    }

    public function testSetTaxonomy(): void
    {
        $expected = "skin";
        $model = $this->model;
        $model->setTaxonomy($expected);

        $this->assertEquals($expected, $model->getTaxonomy());
    }

    public function testGetDescription(): void
    {
        $this->assertEquals($this->dto->description, $this->model->getDescription());
    }

    public function testSetDescription(): void
    {
        $expected = "Place anyone perhaps cost radio explain.";
        $model = $this->model;
        $model->setDescription($expected);

        $this->assertEquals($expected, $model->getDescription());
    }

    public function testGetParent(): void
    {
        $this->assertEquals($this->dto->parent, $this->model->getParent());
    }

    public function testSetParent(): void
    {
        $expected = 6025;
        $model = $this->model;
        $model->setParent($expected);

        $this->assertEquals($expected, $model->getParent());
    }

    public function testGetCount(): void
    {
        $this->assertEquals($this->dto->count, $this->model->getCount());
    }

    public function testSetCount(): void
    {
        $expected = 9027;
        $model = $this->model;
        $model->setCount($expected);

        $this->assertEquals($expected, $model->getCount());
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
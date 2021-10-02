<?php

declare(strict_types=1);

namespace WordPress\Tests\WpTermRelationships;

use PHPUnit\Framework\TestCase;
use WordPress\WpTermRelationships\{ WpTermRelationshipsDto, WpTermRelationshipsModel };

class WpTermRelationshipsModelTest extends TestCase
{
    private array $input;
    private WpTermRelationshipsDto $dto;
    private WpTermRelationshipsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "object_id" => 4599,
            "term_taxonomy_id" => 2398,
            "term_order" => 747,
        ];
        $this->dto = new WpTermRelationshipsDto($this->input);
        $this->model = new WpTermRelationshipsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpTermRelationshipsModel(null);

        $this->assertInstanceOf(WpTermRelationshipsModel::class, $model);
    }

    public function testGetObjectId(): void
    {
        $this->assertEquals($this->dto->objectId, $this->model->getObjectId());
    }

    public function testSetObjectId(): void
    {
        $expected = 534;
        $model = $this->model;
        $model->setObjectId($expected);

        $this->assertEquals($expected, $model->getObjectId());
    }

    public function testGetTermTaxonomyId(): void
    {
        $this->assertEquals($this->dto->termTaxonomyId, $this->model->getTermTaxonomyId());
    }

    public function testSetTermTaxonomyId(): void
    {
        $expected = 7418;
        $model = $this->model;
        $model->setTermTaxonomyId($expected);

        $this->assertEquals($expected, $model->getTermTaxonomyId());
    }

    public function testGetTermOrder(): void
    {
        $this->assertEquals($this->dto->termOrder, $this->model->getTermOrder());
    }

    public function testSetTermOrder(): void
    {
        $expected = 714;
        $model = $this->model;
        $model->setTermOrder($expected);

        $this->assertEquals($expected, $model->getTermOrder());
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
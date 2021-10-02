<?php

declare(strict_types=1);

namespace WordPress\Tests\WpCommentmeta;

use PHPUnit\Framework\TestCase;
use WordPress\WpCommentmeta\{ WpCommentmetaDto, WpCommentmetaModel };

class WpCommentmetaModelTest extends TestCase
{
    private array $input;
    private WpCommentmetaDto $dto;
    private WpCommentmetaModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "meta_id" => 3289,
            "comment_id" => 3588,
            "meta_key" => "party",
            "meta_value" => "Record tell give option. Along rise enjoy will across kind director.",
        ];
        $this->dto = new WpCommentmetaDto($this->input);
        $this->model = new WpCommentmetaModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpCommentmetaModel(null);

        $this->assertInstanceOf(WpCommentmetaModel::class, $model);
    }

    public function testGetMetaId(): void
    {
        $this->assertEquals($this->dto->metaId, $this->model->getMetaId());
    }

    public function testSetMetaId(): void
    {
        $expected = 1767;
        $model = $this->model;
        $model->setMetaId($expected);

        $this->assertEquals($expected, $model->getMetaId());
    }

    public function testGetCommentId(): void
    {
        $this->assertEquals($this->dto->commentId, $this->model->getCommentId());
    }

    public function testSetCommentId(): void
    {
        $expected = 5353;
        $model = $this->model;
        $model->setCommentId($expected);

        $this->assertEquals($expected, $model->getCommentId());
    }

    public function testGetMetaKey(): void
    {
        $this->assertEquals($this->dto->metaKey, $this->model->getMetaKey());
    }

    public function testSetMetaKey(): void
    {
        $expected = "send";
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
        $expected = "Meeting agency show safe color shoulder account.";
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
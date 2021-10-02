<?php

declare(strict_types=1);

namespace WordPress\Tests\WpLinks;

use PHPUnit\Framework\TestCase;
use WordPress\WpLinks\{ WpLinksDto, WpLinksModel };

class WpLinksModelTest extends TestCase
{
    private array $input;
    private WpLinksDto $dto;
    private WpLinksModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "link_id" => 6705,
            "link_url" => "hospital",
            "link_name" => "resource",
            "link_image" => "everybody",
            "link_target" => "various",
            "link_description" => "action",
            "link_visible" => "message",
            "link_owner" => 6658,
            "link_rating" => 2885,
            "link_updated" => "2021-10-12 05:47:30",
            "link_rel" => "million",
            "link_notes" => "And data painting same anyone society audience. Mission lose mission remain technology.",
            "link_rss" => "red",
        ];
        $this->dto = new WpLinksDto($this->input);
        $this->model = new WpLinksModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpLinksModel(null);

        $this->assertInstanceOf(WpLinksModel::class, $model);
    }

    public function testGetLinkId(): void
    {
        $this->assertEquals($this->dto->linkId, $this->model->getLinkId());
    }

    public function testSetLinkId(): void
    {
        $expected = 4733;
        $model = $this->model;
        $model->setLinkId($expected);

        $this->assertEquals($expected, $model->getLinkId());
    }

    public function testGetLinkUrl(): void
    {
        $this->assertEquals($this->dto->linkUrl, $this->model->getLinkUrl());
    }

    public function testSetLinkUrl(): void
    {
        $expected = "grow";
        $model = $this->model;
        $model->setLinkUrl($expected);

        $this->assertEquals($expected, $model->getLinkUrl());
    }

    public function testGetLinkName(): void
    {
        $this->assertEquals($this->dto->linkName, $this->model->getLinkName());
    }

    public function testSetLinkName(): void
    {
        $expected = "best";
        $model = $this->model;
        $model->setLinkName($expected);

        $this->assertEquals($expected, $model->getLinkName());
    }

    public function testGetLinkImage(): void
    {
        $this->assertEquals($this->dto->linkImage, $this->model->getLinkImage());
    }

    public function testSetLinkImage(): void
    {
        $expected = "ahead";
        $model = $this->model;
        $model->setLinkImage($expected);

        $this->assertEquals($expected, $model->getLinkImage());
    }

    public function testGetLinkTarget(): void
    {
        $this->assertEquals($this->dto->linkTarget, $this->model->getLinkTarget());
    }

    public function testSetLinkTarget(): void
    {
        $expected = "base";
        $model = $this->model;
        $model->setLinkTarget($expected);

        $this->assertEquals($expected, $model->getLinkTarget());
    }

    public function testGetLinkDescription(): void
    {
        $this->assertEquals($this->dto->linkDescription, $this->model->getLinkDescription());
    }

    public function testSetLinkDescription(): void
    {
        $expected = "reason";
        $model = $this->model;
        $model->setLinkDescription($expected);

        $this->assertEquals($expected, $model->getLinkDescription());
    }

    public function testGetLinkVisible(): void
    {
        $this->assertEquals($this->dto->linkVisible, $this->model->getLinkVisible());
    }

    public function testSetLinkVisible(): void
    {
        $expected = "service";
        $model = $this->model;
        $model->setLinkVisible($expected);

        $this->assertEquals($expected, $model->getLinkVisible());
    }

    public function testGetLinkOwner(): void
    {
        $this->assertEquals($this->dto->linkOwner, $this->model->getLinkOwner());
    }

    public function testSetLinkOwner(): void
    {
        $expected = 1510;
        $model = $this->model;
        $model->setLinkOwner($expected);

        $this->assertEquals($expected, $model->getLinkOwner());
    }

    public function testGetLinkRating(): void
    {
        $this->assertEquals($this->dto->linkRating, $this->model->getLinkRating());
    }

    public function testSetLinkRating(): void
    {
        $expected = 2275;
        $model = $this->model;
        $model->setLinkRating($expected);

        $this->assertEquals($expected, $model->getLinkRating());
    }

    public function testGetLinkUpdated(): void
    {
        $this->assertEquals($this->dto->linkUpdated, $this->model->getLinkUpdated());
    }

    public function testSetLinkUpdated(): void
    {
        $expected = "2021-09-22 10:52:24";
        $model = $this->model;
        $model->setLinkUpdated($expected);

        $this->assertEquals($expected, $model->getLinkUpdated());
    }

    public function testGetLinkRel(): void
    {
        $this->assertEquals($this->dto->linkRel, $this->model->getLinkRel());
    }

    public function testSetLinkRel(): void
    {
        $expected = "way";
        $model = $this->model;
        $model->setLinkRel($expected);

        $this->assertEquals($expected, $model->getLinkRel());
    }

    public function testGetLinkNotes(): void
    {
        $this->assertEquals($this->dto->linkNotes, $this->model->getLinkNotes());
    }

    public function testSetLinkNotes(): void
    {
        $expected = "Result half send art wrong physical. Money away tell left amount people or behind. Arm effort real until build sense magazine.";
        $model = $this->model;
        $model->setLinkNotes($expected);

        $this->assertEquals($expected, $model->getLinkNotes());
    }

    public function testGetLinkRss(): void
    {
        $this->assertEquals($this->dto->linkRss, $this->model->getLinkRss());
    }

    public function testSetLinkRss(): void
    {
        $expected = "million";
        $model = $this->model;
        $model->setLinkRss($expected);

        $this->assertEquals($expected, $model->getLinkRss());
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
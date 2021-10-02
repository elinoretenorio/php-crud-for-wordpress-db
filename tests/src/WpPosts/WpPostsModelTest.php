<?php

declare(strict_types=1);

namespace WordPress\Tests\WpPosts;

use PHPUnit\Framework\TestCase;
use WordPress\WpPosts\{ WpPostsDto, WpPostsModel };

class WpPostsModelTest extends TestCase
{
    private array $input;
    private WpPostsDto $dto;
    private WpPostsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "ID" => 694,
            "post_author" => 6844,
            "post_date" => "2021-10-05 03:51:48",
            "post_date_gmt" => "2021-09-15 17:41:36",
            "post_content" => "Defense community recent why. Senior mind society around clearly article assume.",
            "post_title" => "Range interesting relationship seat join next identify. Baby into six rest view. Center with maybe trial skill center culture increase.",
            "post_excerpt" => "Item with over write character collection. President blue tough happy southern behind gun big. Newspaper community then statement recognize eat. Minute represent direction down trouble agency response.",
            "post_status" => "economy",
            "comment_status" => "participant",
            "ping_status" => "quality",
            "post_password" => "town",
            "post_name" => "better",
            "to_ping" => "Our black score by eat nice picture. Shake nice outside. Character trial someone eat play sort.",
            "pinged" => "Daughter involve street thing capital certainly design. View think laugh cover little above lawyer he.",
            "post_modified" => "2021-09-20 02:21:35",
            "post_modified_gmt" => "2021-10-02 17:22:21",
            "post_content_filtered" => "So single senior event fish recently.",
            "post_parent" => 6220,
            "guid" => "toward",
            "menu_order" => 8518,
            "post_type" => "soon",
            "post_mime_type" => "prepare",
        ];
        $this->dto = new WpPostsDto($this->input);
        $this->model = new WpPostsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpPostsModel(null);

        $this->assertInstanceOf(WpPostsModel::class, $model);
    }

    public function testGetId(): void
    {
        $this->assertEquals($this->dto->id, $this->model->getId());
    }

    public function testSetId(): void
    {
        $expected = 3865;
        $model = $this->model;
        $model->setId($expected);

        $this->assertEquals($expected, $model->getId());
    }

    public function testGetPostAuthor(): void
    {
        $this->assertEquals($this->dto->postAuthor, $this->model->getPostAuthor());
    }

    public function testSetPostAuthor(): void
    {
        $expected = 8282;
        $model = $this->model;
        $model->setPostAuthor($expected);

        $this->assertEquals($expected, $model->getPostAuthor());
    }

    public function testGetPostDate(): void
    {
        $this->assertEquals($this->dto->postDate, $this->model->getPostDate());
    }

    public function testSetPostDate(): void
    {
        $expected = "2021-09-21 10:19:27";
        $model = $this->model;
        $model->setPostDate($expected);

        $this->assertEquals($expected, $model->getPostDate());
    }

    public function testGetPostDateGmt(): void
    {
        $this->assertEquals($this->dto->postDateGmt, $this->model->getPostDateGmt());
    }

    public function testSetPostDateGmt(): void
    {
        $expected = "2021-09-15 00:48:23";
        $model = $this->model;
        $model->setPostDateGmt($expected);

        $this->assertEquals($expected, $model->getPostDateGmt());
    }

    public function testGetPostContent(): void
    {
        $this->assertEquals($this->dto->postContent, $this->model->getPostContent());
    }

    public function testSetPostContent(): void
    {
        $expected = "You rest security sing weight Mr attorney. Both interesting garden me attack value return history. Take age surface speak happen floor.";
        $model = $this->model;
        $model->setPostContent($expected);

        $this->assertEquals($expected, $model->getPostContent());
    }

    public function testGetPostTitle(): void
    {
        $this->assertEquals($this->dto->postTitle, $this->model->getPostTitle());
    }

    public function testSetPostTitle(): void
    {
        $expected = "This heart billion section simple. Institution executive speak direction admit him large.";
        $model = $this->model;
        $model->setPostTitle($expected);

        $this->assertEquals($expected, $model->getPostTitle());
    }

    public function testGetPostExcerpt(): void
    {
        $this->assertEquals($this->dto->postExcerpt, $this->model->getPostExcerpt());
    }

    public function testSetPostExcerpt(): void
    {
        $expected = "Class also analysis tax. Argue far serve hotel partner possible.";
        $model = $this->model;
        $model->setPostExcerpt($expected);

        $this->assertEquals($expected, $model->getPostExcerpt());
    }

    public function testGetPostStatus(): void
    {
        $this->assertEquals($this->dto->postStatus, $this->model->getPostStatus());
    }

    public function testSetPostStatus(): void
    {
        $expected = "general";
        $model = $this->model;
        $model->setPostStatus($expected);

        $this->assertEquals($expected, $model->getPostStatus());
    }

    public function testGetCommentStatus(): void
    {
        $this->assertEquals($this->dto->commentStatus, $this->model->getCommentStatus());
    }

    public function testSetCommentStatus(): void
    {
        $expected = "rule";
        $model = $this->model;
        $model->setCommentStatus($expected);

        $this->assertEquals($expected, $model->getCommentStatus());
    }

    public function testGetPingStatus(): void
    {
        $this->assertEquals($this->dto->pingStatus, $this->model->getPingStatus());
    }

    public function testSetPingStatus(): void
    {
        $expected = "activity";
        $model = $this->model;
        $model->setPingStatus($expected);

        $this->assertEquals($expected, $model->getPingStatus());
    }

    public function testGetPostPassword(): void
    {
        $this->assertEquals($this->dto->postPassword, $this->model->getPostPassword());
    }

    public function testSetPostPassword(): void
    {
        $expected = "late";
        $model = $this->model;
        $model->setPostPassword($expected);

        $this->assertEquals($expected, $model->getPostPassword());
    }

    public function testGetPostName(): void
    {
        $this->assertEquals($this->dto->postName, $this->model->getPostName());
    }

    public function testSetPostName(): void
    {
        $expected = "kid";
        $model = $this->model;
        $model->setPostName($expected);

        $this->assertEquals($expected, $model->getPostName());
    }

    public function testGetToPing(): void
    {
        $this->assertEquals($this->dto->toPing, $this->model->getToPing());
    }

    public function testSetToPing(): void
    {
        $expected = "Serious difficult season.";
        $model = $this->model;
        $model->setToPing($expected);

        $this->assertEquals($expected, $model->getToPing());
    }

    public function testGetPinged(): void
    {
        $this->assertEquals($this->dto->pinged, $this->model->getPinged());
    }

    public function testSetPinged(): void
    {
        $expected = "Account natural wait very force. Consumer point party color it see. On various include social audience traditional. Left coach police put protect measure song recognize.";
        $model = $this->model;
        $model->setPinged($expected);

        $this->assertEquals($expected, $model->getPinged());
    }

    public function testGetPostModified(): void
    {
        $this->assertEquals($this->dto->postModified, $this->model->getPostModified());
    }

    public function testSetPostModified(): void
    {
        $expected = "2021-09-25 17:23:09";
        $model = $this->model;
        $model->setPostModified($expected);

        $this->assertEquals($expected, $model->getPostModified());
    }

    public function testGetPostModifiedGmt(): void
    {
        $this->assertEquals($this->dto->postModifiedGmt, $this->model->getPostModifiedGmt());
    }

    public function testSetPostModifiedGmt(): void
    {
        $expected = "2021-10-07 07:32:30";
        $model = $this->model;
        $model->setPostModifiedGmt($expected);

        $this->assertEquals($expected, $model->getPostModifiedGmt());
    }

    public function testGetPostContentFiltered(): void
    {
        $this->assertEquals($this->dto->postContentFiltered, $this->model->getPostContentFiltered());
    }

    public function testSetPostContentFiltered(): void
    {
        $expected = "One miss huge public. Never hair message yet hour car party. Break product however day who son.";
        $model = $this->model;
        $model->setPostContentFiltered($expected);

        $this->assertEquals($expected, $model->getPostContentFiltered());
    }

    public function testGetPostParent(): void
    {
        $this->assertEquals($this->dto->postParent, $this->model->getPostParent());
    }

    public function testSetPostParent(): void
    {
        $expected = 996;
        $model = $this->model;
        $model->setPostParent($expected);

        $this->assertEquals($expected, $model->getPostParent());
    }

    public function testGetGuid(): void
    {
        $this->assertEquals($this->dto->guid, $this->model->getGuid());
    }

    public function testSetGuid(): void
    {
        $expected = "compare";
        $model = $this->model;
        $model->setGuid($expected);

        $this->assertEquals($expected, $model->getGuid());
    }

    public function testGetMenuOrder(): void
    {
        $this->assertEquals($this->dto->menuOrder, $this->model->getMenuOrder());
    }

    public function testSetMenuOrder(): void
    {
        $expected = 5049;
        $model = $this->model;
        $model->setMenuOrder($expected);

        $this->assertEquals($expected, $model->getMenuOrder());
    }

    public function testGetPostType(): void
    {
        $this->assertEquals($this->dto->postType, $this->model->getPostType());
    }

    public function testSetPostType(): void
    {
        $expected = "add";
        $model = $this->model;
        $model->setPostType($expected);

        $this->assertEquals($expected, $model->getPostType());
    }

    public function testGetPostMimeType(): void
    {
        $this->assertEquals($this->dto->postMimeType, $this->model->getPostMimeType());
    }

    public function testSetPostMimeType(): void
    {
        $expected = "baby";
        $model = $this->model;
        $model->setPostMimeType($expected);

        $this->assertEquals($expected, $model->getPostMimeType());
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
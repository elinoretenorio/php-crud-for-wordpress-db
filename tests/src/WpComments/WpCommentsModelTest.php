<?php

declare(strict_types=1);

namespace WordPress\Tests\WpComments;

use PHPUnit\Framework\TestCase;
use WordPress\WpComments\{ WpCommentsDto, WpCommentsModel };

class WpCommentsModelTest extends TestCase
{
    private array $input;
    private WpCommentsDto $dto;
    private WpCommentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "comment_ID" => 504,
            "comment_post_ID" => 7986,
            "comment_author" => "Away result every long source business.",
            "comment_author_email" => "erinblackwell@example.net",
            "comment_author_url" => "woman",
            "comment_author_IP" => "media",
            "comment_date" => "2021-09-23 07:40:47",
            "comment_date_gmt" => "2021-09-16 19:21:00",
            "comment_content" => "Energy individual debate leader arrive part baby. Unit president set good. Everyone past indeed future.",
            "comment_karma" => 9494,
            "comment_approved" => "option",
            "comment_agent" => "must",
            "comment_type" => "speech",
            "comment_parent" => 4552,
            "user_id" => 6190,
        ];
        $this->dto = new WpCommentsDto($this->input);
        $this->model = new WpCommentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpCommentsModel(null);

        $this->assertInstanceOf(WpCommentsModel::class, $model);
    }

    public function testGetCommentId(): void
    {
        $this->assertEquals($this->dto->commentId, $this->model->getCommentId());
    }

    public function testSetCommentId(): void
    {
        $expected = 760;
        $model = $this->model;
        $model->setCommentId($expected);

        $this->assertEquals($expected, $model->getCommentId());
    }

    public function testGetCommentPostId(): void
    {
        $this->assertEquals($this->dto->commentPostId, $this->model->getCommentPostId());
    }

    public function testSetCommentPostId(): void
    {
        $expected = 3832;
        $model = $this->model;
        $model->setCommentPostId($expected);

        $this->assertEquals($expected, $model->getCommentPostId());
    }

    public function testGetCommentAuthor(): void
    {
        $this->assertEquals($this->dto->commentAuthor, $this->model->getCommentAuthor());
    }

    public function testSetCommentAuthor(): void
    {
        $expected = "Community official explain remain interview my health program.";
        $model = $this->model;
        $model->setCommentAuthor($expected);

        $this->assertEquals($expected, $model->getCommentAuthor());
    }

    public function testGetCommentAuthorEmail(): void
    {
        $this->assertEquals($this->dto->commentAuthorEmail, $this->model->getCommentAuthorEmail());
    }

    public function testSetCommentAuthorEmail(): void
    {
        $expected = "james09@example.net";
        $model = $this->model;
        $model->setCommentAuthorEmail($expected);

        $this->assertEquals($expected, $model->getCommentAuthorEmail());
    }

    public function testGetCommentAuthorUrl(): void
    {
        $this->assertEquals($this->dto->commentAuthorUrl, $this->model->getCommentAuthorUrl());
    }

    public function testSetCommentAuthorUrl(): void
    {
        $expected = "kind";
        $model = $this->model;
        $model->setCommentAuthorUrl($expected);

        $this->assertEquals($expected, $model->getCommentAuthorUrl());
    }

    public function testGetCommentAuthorIp(): void
    {
        $this->assertEquals($this->dto->commentAuthorIp, $this->model->getCommentAuthorIp());
    }

    public function testSetCommentAuthorIp(): void
    {
        $expected = "bill";
        $model = $this->model;
        $model->setCommentAuthorIp($expected);

        $this->assertEquals($expected, $model->getCommentAuthorIp());
    }

    public function testGetCommentDate(): void
    {
        $this->assertEquals($this->dto->commentDate, $this->model->getCommentDate());
    }

    public function testSetCommentDate(): void
    {
        $expected = "2021-10-01 07:52:42";
        $model = $this->model;
        $model->setCommentDate($expected);

        $this->assertEquals($expected, $model->getCommentDate());
    }

    public function testGetCommentDateGmt(): void
    {
        $this->assertEquals($this->dto->commentDateGmt, $this->model->getCommentDateGmt());
    }

    public function testSetCommentDateGmt(): void
    {
        $expected = "2021-09-23 07:03:08";
        $model = $this->model;
        $model->setCommentDateGmt($expected);

        $this->assertEquals($expected, $model->getCommentDateGmt());
    }

    public function testGetCommentContent(): void
    {
        $this->assertEquals($this->dto->commentContent, $this->model->getCommentContent());
    }

    public function testSetCommentContent(): void
    {
        $expected = "Onto rather alone rate. Amount pattern dog firm cup small until. Alone investment pass picture reveal see usually office.";
        $model = $this->model;
        $model->setCommentContent($expected);

        $this->assertEquals($expected, $model->getCommentContent());
    }

    public function testGetCommentKarma(): void
    {
        $this->assertEquals($this->dto->commentKarma, $this->model->getCommentKarma());
    }

    public function testSetCommentKarma(): void
    {
        $expected = 4632;
        $model = $this->model;
        $model->setCommentKarma($expected);

        $this->assertEquals($expected, $model->getCommentKarma());
    }

    public function testGetCommentApproved(): void
    {
        $this->assertEquals($this->dto->commentApproved, $this->model->getCommentApproved());
    }

    public function testSetCommentApproved(): void
    {
        $expected = "suffer";
        $model = $this->model;
        $model->setCommentApproved($expected);

        $this->assertEquals($expected, $model->getCommentApproved());
    }

    public function testGetCommentAgent(): void
    {
        $this->assertEquals($this->dto->commentAgent, $this->model->getCommentAgent());
    }

    public function testSetCommentAgent(): void
    {
        $expected = "seek";
        $model = $this->model;
        $model->setCommentAgent($expected);

        $this->assertEquals($expected, $model->getCommentAgent());
    }

    public function testGetCommentType(): void
    {
        $this->assertEquals($this->dto->commentType, $this->model->getCommentType());
    }

    public function testSetCommentType(): void
    {
        $expected = "forward";
        $model = $this->model;
        $model->setCommentType($expected);

        $this->assertEquals($expected, $model->getCommentType());
    }

    public function testGetCommentParent(): void
    {
        $this->assertEquals($this->dto->commentParent, $this->model->getCommentParent());
    }

    public function testSetCommentParent(): void
    {
        $expected = 7767;
        $model = $this->model;
        $model->setCommentParent($expected);

        $this->assertEquals($expected, $model->getCommentParent());
    }

    public function testGetUserId(): void
    {
        $this->assertEquals($this->dto->userId, $this->model->getUserId());
    }

    public function testSetUserId(): void
    {
        $expected = 4061;
        $model = $this->model;
        $model->setUserId($expected);

        $this->assertEquals($expected, $model->getUserId());
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
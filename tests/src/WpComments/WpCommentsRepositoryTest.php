<?php

declare(strict_types=1);

namespace WordPress\Tests\WpComments;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpComments\{ WpCommentsDto, IWpCommentsRepository, WpCommentsRepository };

class WpCommentsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpCommentsDto $dto;
    private IWpCommentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "comment_ID" => 3270,
            "comment_post_ID" => 650,
            "comment_author" => "Mouth peace discuss.",
            "comment_author_email" => "harrisonlisa@example.net",
            "comment_author_url" => "bank",
            "comment_author_IP" => "one",
            "comment_date" => "2021-09-21 13:52:38",
            "comment_date_gmt" => "2021-10-14 13:25:26",
            "comment_content" => "White economic security when. Attorney walk tend. Strong ready know.",
            "comment_karma" => 4325,
            "comment_approved" => "painting",
            "comment_agent" => "until",
            "comment_type" => "officer",
            "comment_parent" => 6103,
            "user_id" => 9699,
        ];
        $this->dto = new WpCommentsDto($this->input);
        $this->repository = new WpCommentsRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 1536;

        $sql = "INSERT INTO `wp_comments` (`comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->commentPostId,
                $this->dto->commentAuthor,
                $this->dto->commentAuthorEmail,
                $this->dto->commentAuthorUrl,
                $this->dto->commentAuthorIp,
                $this->dto->commentDate,
                $this->dto->commentDateGmt,
                $this->dto->commentContent,
                $this->dto->commentKarma,
                $this->dto->commentApproved,
                $this->dto->commentAgent,
                $this->dto->commentType,
                $this->dto->commentParent,
                $this->dto->userId
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 9857;

        $sql = "UPDATE `wp_comments` SET `comment_post_ID` = ?, `comment_author` = ?, `comment_author_email` = ?, `comment_author_url` = ?, `comment_author_IP` = ?, `comment_date` = ?, `comment_date_gmt` = ?, `comment_content` = ?, `comment_karma` = ?, `comment_approved` = ?, `comment_agent` = ?, `comment_type` = ?, `comment_parent` = ?, `user_id` = ?
                WHERE `comment_ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->commentPostId,
                $this->dto->commentAuthor,
                $this->dto->commentAuthorEmail,
                $this->dto->commentAuthorUrl,
                $this->dto->commentAuthorIp,
                $this->dto->commentDate,
                $this->dto->commentDateGmt,
                $this->dto->commentContent,
                $this->dto->commentKarma,
                $this->dto->commentApproved,
                $this->dto->commentAgent,
                $this->dto->commentType,
                $this->dto->commentParent,
                $this->dto->userId,
                $this->dto->commentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $commentId = 7612;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($commentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $commentId = 3591;

        $sql = "SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`
                FROM `wp_comments` WHERE `comment_ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$commentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($commentId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`
                FROM `wp_comments`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $commentId = 7489;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($commentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $commentId = 9502;
        $expected = 2928;

        $sql = "DELETE FROM `wp_comments` WHERE `comment_ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$commentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($commentId);
        $this->assertEquals($expected, $actual);
    }
}
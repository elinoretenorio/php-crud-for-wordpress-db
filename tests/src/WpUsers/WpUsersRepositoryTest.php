<?php

declare(strict_types=1);

namespace WordPress\Tests\WpUsers;

use PHPUnit\Framework\TestCase;
use WordPress\Database\DatabaseException;
use WordPress\WpUsers\{ WpUsersDto, IWpUsersRepository, WpUsersRepository };

class WpUsersRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WpUsersDto $dto;
    private IWpUsersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("WordPress\Database\IDatabase");
        $this->result = $this->createMock("WordPress\Database\IDatabaseResult");
        $this->input = [
            "ID" => 5834,
            "user_login" => "language",
            "user_pass" => "onto",
            "user_nicename" => "positive",
            "user_email" => "hector97@example.com",
            "user_url" => "thing",
            "user_registered" => "2021-09-22 11:24:15",
            "user_activation_key" => "resource",
            "user_status" => 1297,
            "display_name" => "together",
        ];
        $this->dto = new WpUsersDto($this->input);
        $this->repository = new WpUsersRepository($this->db);
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
        $expected = 9025;

        $sql = "INSERT INTO `wp_users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->userLogin,
                $this->dto->userPass,
                $this->dto->userNicename,
                $this->dto->userEmail,
                $this->dto->userUrl,
                $this->dto->userRegistered,
                $this->dto->userActivationKey,
                $this->dto->userStatus,
                $this->dto->displayName
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
        $expected = 6120;

        $sql = "UPDATE `wp_users` SET `user_login` = ?, `user_pass` = ?, `user_nicename` = ?, `user_email` = ?, `user_url` = ?, `user_registered` = ?, `user_activation_key` = ?, `user_status` = ?, `display_name` = ?
                WHERE `ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->userLogin,
                $this->dto->userPass,
                $this->dto->userNicename,
                $this->dto->userEmail,
                $this->dto->userUrl,
                $this->dto->userRegistered,
                $this->dto->userActivationKey,
                $this->dto->userStatus,
                $this->dto->displayName,
                $this->dto->id
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $id = 7954;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($id);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $id = 8119;

        $sql = "SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`
                FROM `wp_users` WHERE `ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$id]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($id);
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
        $sql = "SELECT `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`
                FROM `wp_users`";

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
        $id = 2197;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($id);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $id = 1599;
        $expected = 9583;

        $sql = "DELETE FROM `wp_users` WHERE `ID` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$id]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($id);
        $this->assertEquals($expected, $actual);
    }
}
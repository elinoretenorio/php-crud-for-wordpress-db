<?php

declare(strict_types=1);

namespace WordPress\Tests\WpUsers;

use PHPUnit\Framework\TestCase;
use WordPress\WpUsers\{ WpUsersDto, WpUsersModel };

class WpUsersModelTest extends TestCase
{
    private array $input;
    private WpUsersDto $dto;
    private WpUsersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "ID" => 1722,
            "user_login" => "sister",
            "user_pass" => "friend",
            "user_nicename" => "ahead",
            "user_email" => "jennifershepherd@example.org",
            "user_url" => "film",
            "user_registered" => "2021-10-04 21:07:37",
            "user_activation_key" => "before",
            "user_status" => 6532,
            "display_name" => "forget",
        ];
        $this->dto = new WpUsersDto($this->input);
        $this->model = new WpUsersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WpUsersModel(null);

        $this->assertInstanceOf(WpUsersModel::class, $model);
    }

    public function testGetId(): void
    {
        $this->assertEquals($this->dto->id, $this->model->getId());
    }

    public function testSetId(): void
    {
        $expected = 71;
        $model = $this->model;
        $model->setId($expected);

        $this->assertEquals($expected, $model->getId());
    }

    public function testGetUserLogin(): void
    {
        $this->assertEquals($this->dto->userLogin, $this->model->getUserLogin());
    }

    public function testSetUserLogin(): void
    {
        $expected = "value";
        $model = $this->model;
        $model->setUserLogin($expected);

        $this->assertEquals($expected, $model->getUserLogin());
    }

    public function testGetUserPass(): void
    {
        $this->assertEquals($this->dto->userPass, $this->model->getUserPass());
    }

    public function testSetUserPass(): void
    {
        $expected = "international";
        $model = $this->model;
        $model->setUserPass($expected);

        $this->assertEquals($expected, $model->getUserPass());
    }

    public function testGetUserNicename(): void
    {
        $this->assertEquals($this->dto->userNicename, $this->model->getUserNicename());
    }

    public function testSetUserNicename(): void
    {
        $expected = "Democrat";
        $model = $this->model;
        $model->setUserNicename($expected);

        $this->assertEquals($expected, $model->getUserNicename());
    }

    public function testGetUserEmail(): void
    {
        $this->assertEquals($this->dto->userEmail, $this->model->getUserEmail());
    }

    public function testSetUserEmail(): void
    {
        $expected = "cohenjames@example.net";
        $model = $this->model;
        $model->setUserEmail($expected);

        $this->assertEquals($expected, $model->getUserEmail());
    }

    public function testGetUserUrl(): void
    {
        $this->assertEquals($this->dto->userUrl, $this->model->getUserUrl());
    }

    public function testSetUserUrl(): void
    {
        $expected = "strategy";
        $model = $this->model;
        $model->setUserUrl($expected);

        $this->assertEquals($expected, $model->getUserUrl());
    }

    public function testGetUserRegistered(): void
    {
        $this->assertEquals($this->dto->userRegistered, $this->model->getUserRegistered());
    }

    public function testSetUserRegistered(): void
    {
        $expected = "2021-09-29 13:41:50";
        $model = $this->model;
        $model->setUserRegistered($expected);

        $this->assertEquals($expected, $model->getUserRegistered());
    }

    public function testGetUserActivationKey(): void
    {
        $this->assertEquals($this->dto->userActivationKey, $this->model->getUserActivationKey());
    }

    public function testSetUserActivationKey(): void
    {
        $expected = "despite";
        $model = $this->model;
        $model->setUserActivationKey($expected);

        $this->assertEquals($expected, $model->getUserActivationKey());
    }

    public function testGetUserStatus(): void
    {
        $this->assertEquals($this->dto->userStatus, $this->model->getUserStatus());
    }

    public function testSetUserStatus(): void
    {
        $expected = 6742;
        $model = $this->model;
        $model->setUserStatus($expected);

        $this->assertEquals($expected, $model->getUserStatus());
    }

    public function testGetDisplayName(): void
    {
        $this->assertEquals($this->dto->displayName, $this->model->getDisplayName());
    }

    public function testSetDisplayName(): void
    {
        $expected = "television";
        $model = $this->model;
        $model->setDisplayName($expected);

        $this->assertEquals($expected, $model->getDisplayName());
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
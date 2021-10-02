<?php

declare(strict_types=1);

namespace WordPress\WpUsers;

class WpUsersService implements IWpUsersService
{
    private IWpUsersRepository $repository;

    public function __construct(IWpUsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpUsersModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpUsersModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $id): ?WpUsersModel
    {
        $dto = $this->repository->get($id);
        if ($dto === null) {
            return null;
        }

        return new WpUsersModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpUsersDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpUsersModel($dto);
        }

        return $result;
    }

    public function delete(int $id): int
    {
        return $this->repository->delete($id);
    }

    public function createModel(array $row): ?WpUsersModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpUsersDto($row);

        return new WpUsersModel($dto);
    }
}
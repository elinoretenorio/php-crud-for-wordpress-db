<?php

declare(strict_types=1);

namespace WordPress\WpPosts;

class WpPostsService implements IWpPostsService
{
    private IWpPostsRepository $repository;

    public function __construct(IWpPostsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpPostsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpPostsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $id): ?WpPostsModel
    {
        $dto = $this->repository->get($id);
        if ($dto === null) {
            return null;
        }

        return new WpPostsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpPostsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpPostsModel($dto);
        }

        return $result;
    }

    public function delete(int $id): int
    {
        return $this->repository->delete($id);
    }

    public function createModel(array $row): ?WpPostsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpPostsDto($row);

        return new WpPostsModel($dto);
    }
}
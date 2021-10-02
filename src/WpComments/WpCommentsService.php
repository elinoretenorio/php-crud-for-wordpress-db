<?php

declare(strict_types=1);

namespace WordPress\WpComments;

class WpCommentsService implements IWpCommentsService
{
    private IWpCommentsRepository $repository;

    public function __construct(IWpCommentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpCommentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpCommentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $commentId): ?WpCommentsModel
    {
        $dto = $this->repository->get($commentId);
        if ($dto === null) {
            return null;
        }

        return new WpCommentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpCommentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpCommentsModel($dto);
        }

        return $result;
    }

    public function delete(int $commentId): int
    {
        return $this->repository->delete($commentId);
    }

    public function createModel(array $row): ?WpCommentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpCommentsDto($row);

        return new WpCommentsModel($dto);
    }
}
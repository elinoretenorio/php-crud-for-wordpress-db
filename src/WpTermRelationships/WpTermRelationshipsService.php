<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

class WpTermRelationshipsService implements IWpTermRelationshipsService
{
    private IWpTermRelationshipsRepository $repository;

    public function __construct(IWpTermRelationshipsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpTermRelationshipsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpTermRelationshipsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $objectId): ?WpTermRelationshipsModel
    {
        $dto = $this->repository->get($objectId);
        if ($dto === null) {
            return null;
        }

        return new WpTermRelationshipsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpTermRelationshipsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpTermRelationshipsModel($dto);
        }

        return $result;
    }

    public function delete(int $objectId): int
    {
        return $this->repository->delete($objectId);
    }

    public function createModel(array $row): ?WpTermRelationshipsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpTermRelationshipsDto($row);

        return new WpTermRelationshipsModel($dto);
    }
}
<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

class WpTermmetaService implements IWpTermmetaService
{
    private IWpTermmetaRepository $repository;

    public function __construct(IWpTermmetaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpTermmetaModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpTermmetaModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $metaId): ?WpTermmetaModel
    {
        $dto = $this->repository->get($metaId);
        if ($dto === null) {
            return null;
        }

        return new WpTermmetaModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpTermmetaDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpTermmetaModel($dto);
        }

        return $result;
    }

    public function delete(int $metaId): int
    {
        return $this->repository->delete($metaId);
    }

    public function createModel(array $row): ?WpTermmetaModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpTermmetaDto($row);

        return new WpTermmetaModel($dto);
    }
}
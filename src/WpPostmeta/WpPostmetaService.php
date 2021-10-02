<?php

declare(strict_types=1);

namespace WordPress\WpPostmeta;

class WpPostmetaService implements IWpPostmetaService
{
    private IWpPostmetaRepository $repository;

    public function __construct(IWpPostmetaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpPostmetaModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpPostmetaModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $metaId): ?WpPostmetaModel
    {
        $dto = $this->repository->get($metaId);
        if ($dto === null) {
            return null;
        }

        return new WpPostmetaModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpPostmetaDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpPostmetaModel($dto);
        }

        return $result;
    }

    public function delete(int $metaId): int
    {
        return $this->repository->delete($metaId);
    }

    public function createModel(array $row): ?WpPostmetaModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpPostmetaDto($row);

        return new WpPostmetaModel($dto);
    }
}
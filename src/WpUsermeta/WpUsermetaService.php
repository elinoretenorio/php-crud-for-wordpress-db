<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

class WpUsermetaService implements IWpUsermetaService
{
    private IWpUsermetaRepository $repository;

    public function __construct(IWpUsermetaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpUsermetaModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpUsermetaModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $umetaId): ?WpUsermetaModel
    {
        $dto = $this->repository->get($umetaId);
        if ($dto === null) {
            return null;
        }

        return new WpUsermetaModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpUsermetaDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpUsermetaModel($dto);
        }

        return $result;
    }

    public function delete(int $umetaId): int
    {
        return $this->repository->delete($umetaId);
    }

    public function createModel(array $row): ?WpUsermetaModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpUsermetaDto($row);

        return new WpUsermetaModel($dto);
    }
}
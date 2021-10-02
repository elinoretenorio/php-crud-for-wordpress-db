<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

class WpLinksService implements IWpLinksService
{
    private IWpLinksRepository $repository;

    public function __construct(IWpLinksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpLinksModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpLinksModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $linkId): ?WpLinksModel
    {
        $dto = $this->repository->get($linkId);
        if ($dto === null) {
            return null;
        }

        return new WpLinksModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpLinksDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpLinksModel($dto);
        }

        return $result;
    }

    public function delete(int $linkId): int
    {
        return $this->repository->delete($linkId);
    }

    public function createModel(array $row): ?WpLinksModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpLinksDto($row);

        return new WpLinksModel($dto);
    }
}
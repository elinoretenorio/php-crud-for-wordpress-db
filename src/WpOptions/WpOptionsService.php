<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

class WpOptionsService implements IWpOptionsService
{
    private IWpOptionsRepository $repository;

    public function __construct(IWpOptionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpOptionsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpOptionsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $optionId): ?WpOptionsModel
    {
        $dto = $this->repository->get($optionId);
        if ($dto === null) {
            return null;
        }

        return new WpOptionsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpOptionsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpOptionsModel($dto);
        }

        return $result;
    }

    public function delete(int $optionId): int
    {
        return $this->repository->delete($optionId);
    }

    public function createModel(array $row): ?WpOptionsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpOptionsDto($row);

        return new WpOptionsModel($dto);
    }
}
<?php

declare(strict_types=1);

namespace WordPress\WpTerms;

class WpTermsService implements IWpTermsService
{
    private IWpTermsRepository $repository;

    public function __construct(IWpTermsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpTermsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpTermsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $termId): ?WpTermsModel
    {
        $dto = $this->repository->get($termId);
        if ($dto === null) {
            return null;
        }

        return new WpTermsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpTermsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpTermsModel($dto);
        }

        return $result;
    }

    public function delete(int $termId): int
    {
        return $this->repository->delete($termId);
    }

    public function createModel(array $row): ?WpTermsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpTermsDto($row);

        return new WpTermsModel($dto);
    }
}
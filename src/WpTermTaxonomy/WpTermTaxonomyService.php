<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

class WpTermTaxonomyService implements IWpTermTaxonomyService
{
    private IWpTermTaxonomyRepository $repository;

    public function __construct(IWpTermTaxonomyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpTermTaxonomyModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpTermTaxonomyModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $termTaxonomyId): ?WpTermTaxonomyModel
    {
        $dto = $this->repository->get($termTaxonomyId);
        if ($dto === null) {
            return null;
        }

        return new WpTermTaxonomyModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpTermTaxonomyDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpTermTaxonomyModel($dto);
        }

        return $result;
    }

    public function delete(int $termTaxonomyId): int
    {
        return $this->repository->delete($termTaxonomyId);
    }

    public function createModel(array $row): ?WpTermTaxonomyModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpTermTaxonomyDto($row);

        return new WpTermTaxonomyModel($dto);
    }
}
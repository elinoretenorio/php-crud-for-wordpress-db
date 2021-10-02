<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

class WpCommentmetaService implements IWpCommentmetaService
{
    private IWpCommentmetaRepository $repository;

    public function __construct(IWpCommentmetaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WpCommentmetaModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WpCommentmetaModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $metaId): ?WpCommentmetaModel
    {
        $dto = $this->repository->get($metaId);
        if ($dto === null) {
            return null;
        }

        return new WpCommentmetaModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WpCommentmetaDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WpCommentmetaModel($dto);
        }

        return $result;
    }

    public function delete(int $metaId): int
    {
        return $this->repository->delete($metaId);
    }

    public function createModel(array $row): ?WpCommentmetaModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WpCommentmetaDto($row);

        return new WpCommentmetaModel($dto);
    }
}
<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpTermTaxonomyController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpTermTaxonomyService $service;

    public function __construct(IWpTermTaxonomyService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpTermTaxonomyModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $termTaxonomyId = (int) ($args["term_taxonomy_id"] ?? 0);
        if ($termTaxonomyId <= 0) {
            return new JsonResponse(["result" => $termTaxonomyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpTermTaxonomyModel $model */
        $model = $this->service->createModel($data);
        $model->setTermTaxonomyId($termTaxonomyId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $termTaxonomyId = (int) ($args["term_taxonomy_id"] ?? 0);
        if ($termTaxonomyId <= 0) {
            return new JsonResponse(["result" => $termTaxonomyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpTermTaxonomyModel $model */
        $model = $this->service->get($termTaxonomyId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpTermTaxonomyModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $termTaxonomyId = (int) ($args["term_taxonomy_id"] ?? 0);
        if ($termTaxonomyId <= 0) {
            return new JsonResponse(["result" => $termTaxonomyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($termTaxonomyId);

        return new JsonResponse(["result" => $result]);
    }
}
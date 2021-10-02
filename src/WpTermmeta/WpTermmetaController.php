<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpTermmetaController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpTermmetaService $service;

    public function __construct(IWpTermmetaService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpTermmetaModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $metaId = (int) ($args["meta_id"] ?? 0);
        if ($metaId <= 0) {
            return new JsonResponse(["result" => $metaId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpTermmetaModel $model */
        $model = $this->service->createModel($data);
        $model->setMetaId($metaId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $metaId = (int) ($args["meta_id"] ?? 0);
        if ($metaId <= 0) {
            return new JsonResponse(["result" => $metaId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpTermmetaModel $model */
        $model = $this->service->get($metaId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpTermmetaModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $metaId = (int) ($args["meta_id"] ?? 0);
        if ($metaId <= 0) {
            return new JsonResponse(["result" => $metaId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($metaId);

        return new JsonResponse(["result" => $result]);
    }
}
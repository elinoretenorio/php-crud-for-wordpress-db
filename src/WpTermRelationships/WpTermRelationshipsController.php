<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpTermRelationshipsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpTermRelationshipsService $service;

    public function __construct(IWpTermRelationshipsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpTermRelationshipsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $objectId = (int) ($args["object_id"] ?? 0);
        if ($objectId <= 0) {
            return new JsonResponse(["result" => $objectId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpTermRelationshipsModel $model */
        $model = $this->service->createModel($data);
        $model->setObjectId($objectId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $objectId = (int) ($args["object_id"] ?? 0);
        if ($objectId <= 0) {
            return new JsonResponse(["result" => $objectId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpTermRelationshipsModel $model */
        $model = $this->service->get($objectId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpTermRelationshipsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $objectId = (int) ($args["object_id"] ?? 0);
        if ($objectId <= 0) {
            return new JsonResponse(["result" => $objectId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($objectId);

        return new JsonResponse(["result" => $result]);
    }
}
<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpUsermetaController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpUsermetaService $service;

    public function __construct(IWpUsermetaService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpUsermetaModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $umetaId = (int) ($args["umeta_id"] ?? 0);
        if ($umetaId <= 0) {
            return new JsonResponse(["result" => $umetaId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpUsermetaModel $model */
        $model = $this->service->createModel($data);
        $model->setUmetaId($umetaId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $umetaId = (int) ($args["umeta_id"] ?? 0);
        if ($umetaId <= 0) {
            return new JsonResponse(["result" => $umetaId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpUsermetaModel $model */
        $model = $this->service->get($umetaId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpUsermetaModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $umetaId = (int) ($args["umeta_id"] ?? 0);
        if ($umetaId <= 0) {
            return new JsonResponse(["result" => $umetaId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($umetaId);

        return new JsonResponse(["result" => $result]);
    }
}
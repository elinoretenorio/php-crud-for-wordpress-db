<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpCommentmetaController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpCommentmetaService $service;

    public function __construct(IWpCommentmetaService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpCommentmetaModel $model */
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

        /** @var WpCommentmetaModel $model */
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

        /** @var WpCommentmetaModel $model */
        $model = $this->service->get($metaId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpCommentmetaModel $model */
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
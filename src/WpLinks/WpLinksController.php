<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpLinksController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpLinksService $service;

    public function __construct(IWpLinksService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpLinksModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $linkId = (int) ($args["link_id"] ?? 0);
        if ($linkId <= 0) {
            return new JsonResponse(["result" => $linkId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpLinksModel $model */
        $model = $this->service->createModel($data);
        $model->setLinkId($linkId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $linkId = (int) ($args["link_id"] ?? 0);
        if ($linkId <= 0) {
            return new JsonResponse(["result" => $linkId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpLinksModel $model */
        $model = $this->service->get($linkId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpLinksModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $linkId = (int) ($args["link_id"] ?? 0);
        if ($linkId <= 0) {
            return new JsonResponse(["result" => $linkId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($linkId);

        return new JsonResponse(["result" => $result]);
    }
}
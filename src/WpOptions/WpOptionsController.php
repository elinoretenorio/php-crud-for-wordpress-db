<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpOptionsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpOptionsService $service;

    public function __construct(IWpOptionsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpOptionsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $optionId = (int) ($args["option_id"] ?? 0);
        if ($optionId <= 0) {
            return new JsonResponse(["result" => $optionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpOptionsModel $model */
        $model = $this->service->createModel($data);
        $model->setOptionId($optionId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $optionId = (int) ($args["option_id"] ?? 0);
        if ($optionId <= 0) {
            return new JsonResponse(["result" => $optionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpOptionsModel $model */
        $model = $this->service->get($optionId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpOptionsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $optionId = (int) ($args["option_id"] ?? 0);
        if ($optionId <= 0) {
            return new JsonResponse(["result" => $optionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($optionId);

        return new JsonResponse(["result" => $result]);
    }
}
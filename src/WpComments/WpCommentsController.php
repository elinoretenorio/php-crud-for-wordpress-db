<?php

declare(strict_types=1);

namespace WordPress\WpComments;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WpCommentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IWpCommentsService $service;

    public function __construct(IWpCommentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpCommentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $commentId = (int) ($args["comment_ID"] ?? 0);
        if ($commentId <= 0) {
            return new JsonResponse(["result" => $commentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var WpCommentsModel $model */
        $model = $this->service->createModel($data);
        $model->setCommentId($commentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $commentId = (int) ($args["comment_ID"] ?? 0);
        if ($commentId <= 0) {
            return new JsonResponse(["result" => $commentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var WpCommentsModel $model */
        $model = $this->service->get($commentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var WpCommentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $commentId = (int) ($args["comment_ID"] ?? 0);
        if ($commentId <= 0) {
            return new JsonResponse(["result" => $commentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($commentId);

        return new JsonResponse(["result" => $result]);
    }
}
<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

use JsonSerializable;

class WpOptionsModel implements JsonSerializable
{
    private int $optionId;
    private string $optionName;
    private string $optionValue;
    private string $autoload;

    public function __construct(WpOptionsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->optionId = $dto->optionId;
        $this->optionName = $dto->optionName;
        $this->optionValue = $dto->optionValue;
        $this->autoload = $dto->autoload;
    }

    public function getOptionId(): int
    {
        return $this->optionId;
    }

    public function setOptionId(int $optionId): void
    {
        $this->optionId = $optionId;
    }

    public function getOptionName(): string
    {
        return $this->optionName;
    }

    public function setOptionName(string $optionName): void
    {
        $this->optionName = $optionName;
    }

    public function getOptionValue(): string
    {
        return $this->optionValue;
    }

    public function setOptionValue(string $optionValue): void
    {
        $this->optionValue = $optionValue;
    }

    public function getAutoload(): string
    {
        return $this->autoload;
    }

    public function setAutoload(string $autoload): void
    {
        $this->autoload = $autoload;
    }

    public function toDto(): WpOptionsDto
    {
        $dto = new WpOptionsDto();
        $dto->optionId = (int) ($this->optionId ?? 0);
        $dto->optionName = $this->optionName ?? "";
        $dto->optionValue = $this->optionValue ?? "";
        $dto->autoload = $this->autoload ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "option_id" => $this->optionId,
            "option_name" => $this->optionName,
            "option_value" => $this->optionValue,
            "autoload" => $this->autoload,
        ];
    }
}
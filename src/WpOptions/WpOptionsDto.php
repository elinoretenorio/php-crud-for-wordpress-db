<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

class WpOptionsDto 
{
    public int $optionId;
    public string $optionName;
    public string $optionValue;
    public string $autoload;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->optionId = (int) ($row["option_id"] ?? 0);
        $this->optionName = $row["option_name"] ?? "";
        $this->optionValue = $row["option_value"] ?? "";
        $this->autoload = $row["autoload"] ?? "";
    }
}
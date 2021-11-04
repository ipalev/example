<?php

namespace Its\Config;

interface ComponentInterface
{
    public function getInitialParametersArray(): array;

    public function getParentParams(array $arParentParams): array;

    public function getParentResult(array $arParentResult): array;

    public function getParameters(): array;

    public function getParameter(string $name);

    public function removeParameter(string $name): void;

    public function addParameters(array $parameters): void;
}
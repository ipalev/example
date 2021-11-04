<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

abstract class BaseModal implements ModalInterface
{
    /** @var bool */
    private $instantOpen = false;

    abstract public function getModalId(): string;

    abstract public function renderModal(): void;

    public function __construct()
    {
        $this->init();
    }

    public function init(): void {}

    public function isInstantOpen(): bool
    {
        return $this->instantOpen;
    }

    public function setInstantOpen(bool $flag): self
    {
        $this->instantOpen = $flag;

        return $this;
    }
}
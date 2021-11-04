<?php

namespace Its\Lib\Modal;

interface ModalInterface
{
    public function renderModal();

    public function getModalId(): string;
}
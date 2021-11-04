<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class NewOrderModal extends BaseModal
{
    /** @var int */
    protected $orderId;

    public function getModalId(): string
    {
        return 'modalNewOrder';
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/new-order.php';

        if(file_exists($file)) include_once($file);
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }
}
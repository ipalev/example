<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class PersonalOrderModal extends NewOrderModal
{
    public static function generateModalId(int $orderId): string
    {
        return 'modalPersonalOrder'.((string)$orderId);
    }

    public function getModalId(): string
    {
        if(!$this->orderId) {
            throw new \Exception('Personal Order Modal must have order id');
        }

        return static::generateModalId($this->orderId);
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/personal-order.php';

        if(file_exists($file)) include_once($file);
    }
}
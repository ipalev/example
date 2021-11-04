<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class ForgotPasswordModal extends AuthModal
{
    public function getModalId(): string
    {
        return 'modalLostPassword';
    }

    public function initFields(): void
    {
        $this->setFields([
            'AUTH_FORM' => '',
            'TYPE' => '',
        ]);
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/lost-password.php';

        if(file_exists($file)) include_once($file);
    }
}
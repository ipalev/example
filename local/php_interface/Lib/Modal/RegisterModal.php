<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class RegisterModal extends AuthModal
{
    public function getModalId(): string
    {
        return 'modalRegistration';
    }

    public function initFields(): void
    {
        $this->setFields([
            'register_submit_button' => 'y',
            'sessid' => bitrix_sessid(),
            'REGISTER[LOGIN]' => 'user-'.randString(),
        ]);
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/registration.php';

        if(file_exists($file)) include_once($file);
    }
}
<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class ConfirmMailModal extends BaseModal
{
    public function getModalId(): string
    {
        return 'modalRegistrationDone';
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/confirm_mail.php';

        if(file_exists($file)) include_once($file);
    }
}
<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class ChangePasswordModal extends BaseModal
{
    public function getModalId(): string
    {
        return 'modalChangePassword';
    }

    public function initFields(): void
    {
        $this->setFields([
            'lang' => LANG,
            'sessid' => bitrix_sessid(),
        ]);
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/change-password.php';

        if(file_exists($file)) include_once($file);
    }
}
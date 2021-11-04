<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;

class AuthModal extends BaseModal
{
    /** @var string[] */
    private $fields = [];

    public function getModalId(): string
    {
        return 'modalEnter';
    }

    public function init(): void
    {
        $this->initFields();
    }

    public function initFields(): void
    {
        $this->setFields([
            'AUTH_FORM' => 'Y',
            'TYPE' => 'AUTH',
        ]);
    }

    public function renderModal(): void
    {
        $file = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/include/blocks/modal-processor/enter.php';

        if(file_exists($file)) include_once($file);
    }

    /** @return string[] */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function setField(string $field, string $value): self
    {
        if(!strlen($field)) return $this;

        $this->fields[$field] = $value;
        return $this;
    }

    public function setFields(array $fields): self
    {
        if(empty($fields)) return $this;

        foreach ($fields as $field => $value) {
            $this->setField((string) $field, (string) $value);
        }

        return $this;
    }
}
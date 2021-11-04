<?php

namespace Its\Lib\Modal;

use Bitrix\Main\Application;
use Bitrix\Main\Request;
use Bitrix\Main\EventManager;

/**
 * Class ModalProcessor
 * @package Its\Lib
 */
class Processor
{
    /** @var Request */
    private $request;

    /** @var ModalInterface[] */
    private $modals = [];

    /** @var string */
    private static $marker = '<!--:modal-processor:-->';

    /** @var self  */
    static private $instance = null;

    /** @var bool */
    private $inited = false;

    public static function getInstance(): self {
        if(static::$instance === null) {
            static::$instance = new self(
                Application::getInstance()->getContext()->getRequest()
            );
        }

        return static::$instance;
    }

    public function addModal(ModalInterface $modal): self
    {
        $this->modals[] = $modal;

        return $this;
    }

    private function __clone(){}
    private function __wakeup(){}

    private function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function init()
    {
        return true;
        if($this->inited) return;

        EventManager::getInstance()
            ->addEventHandler(
                'main',
                'OnEndBufferContent',
                [static::getInstance(), 'processModals'],
                false,
                1
            );

        $this->inited = true;
    }

    public function processModals()
    {
        global $APPLICATION;
        ob_start();
        foreach ($this->modals as $modal) {
            $modal->renderModal();
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public static function showModals()
    {
        global $APPLICATION;

        echo $APPLICATION->AddBufferContent([static::getInstance(), 'processModals']);
    }

    public static function placeMarker()
    {
        echo self::$marker;
    }
}

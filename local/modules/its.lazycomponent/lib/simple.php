<?php
namespace Its\Spopup;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

class Simple
{
    private $moduleName = 'its.spopup';

    public function show()
    {

    }

    public function getBanner(): \Bitrix\Main\Engine\Response\Component
    {
        return new \Bitrix\Main\Engine\Response\Component(
            'its:popup.banner',
            'lk',
            [
            ],
            [
                'show' => true
            ]
        );
    }

    private function getOption($optionName)
    {
        return Option::get($this->moduleName, $optionName, '');
    }

    public function isNeedShow()
    {
        if ($this->getCookie() === 'y') {
            return false;
        }

        return true;
    }

    public function setCookie()
    {
        $context = Application::getInstance()->getContext();
        $sleep = '100000000';
        $cookie = new Cookie('spopupwasset', 'y', time() + $sleep);
        $cookie->setDomain($context->getServer()->getHttpHost());
        $cookie->setHttpOnly(false);

        $context->getResponse()->addCookie($cookie);
        $context->getResponse()->flush("");
    }

    public function getCookie()
    {
        $request = Application::getInstance()->getContext()->getRequest();

        return $request->getCookie('spopupwasset');
    }
}

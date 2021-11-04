<?php

namespace Its\Lib\Geo\IpCity;

use Dadata\DadataClient;
use GuzzleHttp\Exception\ClientException;
use LogicException;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Service\GeoIp\Manager;


class HelperIpCity
{
    /**
     * @return string
     * @throws LogicException
     */
    public static function getCity()
    {
        $cityName = Application::getInstance()->getContext()->getRequest()->getCookie('CITY_NAME');
        if (empty($cityName)) {
            $userIp = Manager::getRealIp();

            $dadata = new DadataClient(getenv('DADATA_API_KEY'), getenv('DADATA_SECRET'));

            try {
                $response = $dadata->ipLocate($userIp);
            } catch (ClientException $e) {
                throw new LogicException('Ошибка обработки запроса');
            }

            $cityName = $response['data']['city'] ? $response['data']['city'] : 'Санкт-Петербург';
            $cookie = new Cookie('CITY_NAME', $cityName);
            Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
        }
        return $cityName;
    }
}

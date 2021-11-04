<?php

namespace Its\Lib\AjaxApiController;

use Bitrix\Main\Error;
use Bitrix\Main\Result;
use Its\Lib\Geo\Helper;
use Dadata\DadataClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Geo
 *
 * @package Its\Lib
 */

class Geo extends AbstractController
{
    protected function bx_location_codeAction(array $data): Result
    {
        $result = new Result();

        if(empty($data['dadata_array'])) {
            $result->addError(new Error('Передан пустой объект'));
            return $result;
        }

        $result->setData([
            'location_code' => Helper::getBitrixLocation($data['dadata_array'])
        ]);

        return $result;
    }

    protected function city_by_coordinatesAction (array $data): Result
    {
        $result = new Result();
        if ($data['latitude'] && $data['longitude']) {
            try {
                $dadata = new DadataClient(getenv('DADATA_API_KEY'), getenv('DADATA_SECRET'));
                if($response = $dadata->geolocate('address', $data['latitude'], $data['longitude'])) {
                    $result->setData([
                        'city' => current($response)['data']['city']
                    ]);
                    return $result;
                }
            } catch (ClientException $e) {
                $result->addError(new Error('Ошибка обработки запроса'));
                return $result;
            }
        } else {
            $result->addError(new Error('Ошибочные координаты'));
            return $result;
        }
    }
}
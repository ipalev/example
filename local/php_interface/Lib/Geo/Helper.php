<?php

namespace Its\Lib\Geo;

use Bitrix\Main\Loader;
use Bitrix\Sale\Location\Search\Finder;
use Bitrix\Sale\Location\TypeTable;
use Dadata\DadataClient;
use GuzzleHttp\Exception\ClientException;
use Its\Lib\Constant;
use LogicException;

class Helper
{
    /**
     * @param string $address
     * @throws LogicException
     * @return Point
     */
    public static function getCoordinatesByAddress(string $address): Point
    {
        if($address === '') {
            throw new LogicException('Некорректный адрес');
        }

        $dadata = new DadataClient(getenv('DADATA_API_KEY'), getenv('DADATA_SECRET'));
        try {
            $response = $dadata->clean('address', $address);
        } catch (ClientException $e) {
            throw new LogicException('Ошибка обработки запроса');
        }

        if(!$response || !$response['geo_lat'] || !$response['geo_lon']) {
            throw new LogicException(sprintf('Не удалось найти координаты по адресу %s', $address));
        }

        return new Point($response['geo_lat'], $response['geo_lon']);
    }

    public static function getBitrixLocation(array $dadataObject): ?string
    {
        if(!Loader::includeModule('sale')) {
            return null;
        }

        $region = static::findLocation($dadataObject['region'], 'REGION');

        // Если регион не найден, это ещё не означает, что его реально нет. Регионом в реляционном смысле может быть
        // город федерального значения
        $federalCity = false;
        if(!$region) {
            $region = static::findLocation($dadataObject['region'], 'CITY');
            if($region) {
                $federalCity = true;
            } else {
                return null;
            }
        }


        if($dadataObject['city']) {
            if ($federalCity && $dadataObject['region'] == $dadataObject['city']) {
                $locality = $region;
            } else {
                $locality = static::findLocation($dadataObject['city'], 'CITY', $region);
            }
        }
        if(!$locality) {
            $district = static::findLocation($dadataObject['area'], 'SUBREGION', $region);
            $locality = static::findLocation($dadataObject['settlement'], 'VILLAGE', $district);
        }

        if($locality) {
            $streetVariants = [
                $dadataObject['street_with_type'],
                $dadataObject['street'].' '.$dadataObject['street_type_full'],
                $dadataObject['street_type_full'].' '.$dadataObject['street'],
                $dadataObject['street']
            ];

            foreach($streetVariants as $variant){
                if($result = static::findLocation($variant, 'STREET', $locality)['CODE']) {
                    return $result;
                }
            }
        }

        return null;
    }

    public static function findLocation(string $searchQuery, string $type = null, array $parent = []): ?array
    {
        if($type) {
            $typeId = static::getLocTypeId($type);

            if(!$typeId) {
                return null;
            }
        }

        $searchParams = [
            'select' => [
                'ID', 'LEFT_MARGIN', 'RIGHT_MARGIN',
            ],
            'filter' => [
                '=PHRASE' => $searchQuery
            ],
            'limit' => 1
        ];

        if((int) $parent['ID'] > 0) {
            $searchParams['filter']['PARENT_ID'] = $parent['ID'];
        }

        if(isset($typeId)) {
            $searchParams['filter']['TYPE_ID'] = $typeId;
        }

        return Finder::find(
            $searchParams,
            ['USE_INDEX' => true, 'USE_ORM' => true]
        )->fetch() ?: null;
    }

    public static function getLocTypeId(string $type): ?int
    {
        static $types = [];

        if(empty($types)) {
            $arType = TypeTable::getList([
                'select' => [
                    'ID',
                    'CODE'
                ],
            ])->fetchAll();

            $types = array_column($arType, null, 'CODE');
        }

        return array_key_exists($type, $types) ? (int) $types[$type]['ID'] : null;
    }
}

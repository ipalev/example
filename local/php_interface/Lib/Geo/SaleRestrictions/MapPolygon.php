<?php

namespace Its\Lib\Geo\SaleRestrictions;

use Bitrix\Main\Application;
use Bitrix\Sale\Delivery\Restrictions;
use Bitrix\Sale\Internals\CollectableEntity;
use Bitrix\Sale\Internals\Entity;
use Bitrix\Sale\Order;
use Bitrix\Sale\Property;
use Bitrix\Sale\PropertyValue;
use Its\Lib\Geo\Point;
use Its\Lib\Geo\Polygon;

class MapPolygon extends Restrictions\Base
{
    public static function getClassTitle()
    {
        return 'Доставка в пределах полигона';
    }

    public static function getClassDescription()
    {
        return 'Доставка в пределах содержащегося в загруженном geojson полигона на карте';
    }

    public static function check($locationValueObject, array $restriction, $serviceId = 0): bool
    {
        if(!$locationValueObject || !($locationValueObject instanceof PropertyValue)) {
            return false;
        }

        $polygonPath = $restriction['GEOJSON'] ? Application::getDocumentRoot().$restriction['GEOJSON'] : null;

        if(!$polygonPath || !file_exists($polygonPath)) {
            return false;
        }

        if(($location = $locationValueObject->getValue()) && $location !== '') {

            $polygonData = file_get_contents($polygonPath);

            if(!$polygonData) {
                return false;
            }

            try {
                $point = new Point(...explode(',', $location, 2));
            } catch (\ArgumentCountError $e) {
                return false;
            }

            $polygon = Polygon::createPolygonFromGeojson(json_decode($polygonData, true));

            return $polygon->isContentsPoint($point);
        }

        return false;
    }

    protected static function extractParams(Entity $entity)
    {
        if ($entity instanceof CollectableEntity)
        {
            /** @var \Bitrix\Sale\Order $order */
            $order = $entity->getCollection()->getOrder();
        }
        elseif ($entity instanceof Order)
        {
            $order = $entity;
        }

        /** @var \Bitrix\Sale\Order $order */
        if (!$order) return '';

        /** @var Property $property */
        foreach($order->getPropertyCollection() as $property) {
            if($property->getField('CODE') === 'ORDER_LOCATION_COORD') {
                return $property;
            }
        }

        return '';
    }

    public static function getParamsStructure($entityId = 0)
    {
        return [
            'NAME' => [
                'TYPE' => 'STRING',
                'LABEL' => 'Название полигона',
            ],
            'GEOJSON' => [
                'TYPE' => 'STRING',
                'SIZE' => '50',
                'REQUIRED' => 'Y',
                'LABEL' => 'Путь к файлу geojson на сервере',
            ]
        ];
    }
}

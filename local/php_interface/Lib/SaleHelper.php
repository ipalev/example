<?php

namespace Its\Lib;

use Bitrix\Main\Error;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\Result;
use Bitrix\Sale\Internals\EntityCollection;
use Bitrix\Sale\Internals\StatusTable;
use Bitrix\Sale\Internals\UserPropsTable;
use Bitrix\Sale\Internals\UserPropsValueTable;
use Monolog\Registry;

class SaleHelper
{
    /**
     * @param int $userId
     * @return int|null
     */
    public static function getUserProfileId(int $userId): ?int
    {
        $userProfile = null;

        try {
            /** @var EntityObject $userProfile */
            $userProfile = UserPropsTable::query()
                ->setSelect(['ID'])
                ->where('USER_ID', $userId)
                ->fetchObject();
        } catch (\Throwable $a) {}

        return $userProfile ? $userProfile->getId() : null;
    }

    public static function setUserProfileValue(int $userId, array $props = []): Result
    {
        $result = new Result();

        $saleProfileId = self::getUserProfileId($userId);
        if(!$saleProfileId) {
            $result->addError(
                new Error(sprintf('Не найден профиль пользователя с id=%u', $userId))
            );
            return $result;
        }

        $query = UserPropsValueTable::query()
            ->setSelect(['PROPERTY', 'VALUE', 'USER_PROPS_ID'])
            ->where('USER_PROPS_ID', $saleProfileId);

        if(!empty($props)) {
            $query->whereIn('PROPERTY.CODE', array_keys($props));
        }

        /** @var EntityCollection $propertyCollection */
        $propertyCollection = $query->fetchCollection();

        /** @var EntityObject $propertyObject */
        foreach ($propertyCollection as $propertyObject) {
            try {
                if (array_key_exists($propertyObject->getProperty()->getCode(), $props)) {
                    $propertyObject->setValue($props[$propertyObject->getProperty()->getCode()]);
                    throw new \Exception('sad');
                }
                $propertyObject->save();
            } catch (\Throwable $e) {
                $result->addError(
                    new Error(sprintf(
                        'Ошибка при сохранении значения свойства %s [%s]',
                        $propertyObject->getProperty()->getName(),
                        $propertyObject->getProperty()->getCode()
                    ))
                );
                return $result;
            }
        }

        return $result;
    }

    public static function getStatusColor(string $statusLetter): string
    {
        if(!$statuses = static::getStatuses()) {
            foreach ($statuses as $status) {
                if($statusLetter === $status->getId() && $status->getColor()){
                    return $status->getColor();
                }
            }
        }

        switch ($statusLetter) {
            case 'F':
            case 'DF':
                return 'green';
            case 'N':
            case 'DN':
                return 'blue';
            default:
                return 'red';
        }
    }

    /**
     * @param string $statusLetter
     * @return string|null
     */
    public static function getStatusTitle(string $statusLetter): ?string
    {
        if($statuses = static::getStatuses()) {
            foreach ($statuses as $status) {
                if($statusLetter === $status->getId()) {
                    return $status->getStatusLang()->getName();
                }
            }
        }

        return null;
    }

    public static function getStatuses()
    {
        /** @var EntityCollection $statuses */
        static $statuses;

        if(!$statuses) {
            $statuses = StatusTable::query()
                ->setSelect(['ID', 'TYPE', 'STATUS_LANG.NAME', 'STATUS_LANG.DESCRIPTION'])
                ->setOrder(['SORT' => 'ASC'])
                ->where('STATUS_LANG.LID', LANGUAGE_ID)
                ->fetchCollection();
        }

        return $statuses;
    }

    public static function checkEvotorResponse($response) : bool
    {
        if (is_array($response) && $response["HEADERS"]["http_code"] == "200") {
            $result = json_decode($response['RESULT'], true);
            if ($result['deleted'] > 0) {
                return true;
            } else {
                return false;
            }
        } elseif (is_string($response) && strpos($response, 'error') === false) {
            return true;
        } else {
            return false;
        }
    }
}

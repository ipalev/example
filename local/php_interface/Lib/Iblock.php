<?php
namespace Its\Lib;

use Bitrix\Iblock\IblockSiteTable;
use Bitrix\Main\Loader;

class Iblock {

    static private $instance = null;

    static private $iblock = [];
    static private $iblockTypeMap = [];

    /**
     * Gets the instance
     * @return self
     */
    public static function getInstance(): self {
        if(static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * prevent the instance from being cloned
     */
    private function __clone(){}

    /**
     * prevent from being unserialized
     */
    private function __wakeup(){}

    /**
     * Singleton
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private function __construct(){
        Loader::includeModule('iblock');

        $iblocks = IblockSiteTable::query()
            ->setSelect(['SITE_ID', 'IBLOCK_ID', 'IBLOCK_CODE' => 'IBLOCK.CODE', 'IBLOCK_TYPE_ID' => 'IBLOCK.IBLOCK_TYPE_ID'])
            ->where('IBLOCK.ACTIVE', true)
            ->exec();

        while($arIblock = $iblocks->fetch()) {
            static::$iblock[$arIblock['SITE_ID']][$arIblock['IBLOCK_CODE']] = $arIblock['IBLOCK_ID'];

            static::$iblockTypeMap[$arIblock['SITE_ID']][$arIblock['IBLOCK_CODE']] = $arIblock['IBLOCK_TYPE_ID'];
        }
    }

    /**
     * @param string $iblockCode
     * @param string $LID
     * @return int|null
     */
    public function get(string $iblockCode, string $LID = SITE_ID): ?int {
        return array_key_exists($iblockCode, static::$iblock[$LID]) ? static::$iblock[$LID][$iblockCode] : null;
    }

    /**
     * @param string $iblockCode
     * @param string $LID
     * @return string|null
     */
    public function getType(string $iblockCode, string $LID = SITE_ID): ?string {
        return array_key_exists($iblockCode, static::$iblockTypeMap[$LID]) ? static::$iblockTypeMap[$LID][$iblockCode] : null;
    }

    /**
     * @param string $iblockCode
     * @return array
     */
    public function getAll(string $iblockCode): array {
        $result = [];
        foreach(static::$iblock as $siteId => $iblockList){
            if(array_key_exists($iblockCode, $iblockList)) {
                $result[] = $iblockList[$iblockCode];
            }
        }

        return $result;
    }
}
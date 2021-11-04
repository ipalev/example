<?php

namespace Its;

use Bitrix\Main\Loader;
use Bitrix\Main\Entity;

class Getlist extends \CBitrixComponent
{
    public function executeComponent()
    {
        Loader::includeModule('iblock');
        if (empty($this->arParams['CACHE_TIME'])) {
            $this->arParams['CACHE_TIME'] = 3600;
        }
        if ($this->StartResultCache($this->arParams['CACHE_TIME'], $this->arParams)) {
            $this->arResult['slides'] = $this->getSlides();
            $this->arResult['slidesImages'] = $this->getSlideImages($this->arResult['slides'], 'img');
            $this->arResult['slidesImagesMob'] = $this->getSlideImages($this->arResult['slides'], 'img_mob');
            if ($this->arParams['GET_CATEGORIES'] == 'Y') {
                $this->arResult['categories'] = $this->getCategories($this->arResult['slides']);
            }
            if ($this->arParams['GET_SECTIONS'] == 'Y') {
                $this->arResult['sections'] = $this->getSections($this->arResult['slides']);
            }
            if ($this->arParams['BRAND']) {
                $this->arResult['BRAND_DATA'] = $this->getBrandData($this->arParams['BRAND']);
            }
            $this->includeComponentTemplate();
        }
    }

    private function getSlides()
    {
        $outFilter = $this->arParams['filter'] ? $this->arParams['filter'] : [];
        $arNavStartParams = $this->arParams['arNavStartParams'] ? $this->arParams['arNavStartParams'] : false;
        $arGroupBy = $this->arParams['arGroupBy'] ? $this->arParams['arGroupBy'] : false;

        $filter = array_merge([
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $this->getIblockId()
        ], $outFilter);

        $select = [
            'ID',
            'IBLOCK_ID',
            'NAME',
            'PREVIEW_TEXT',
            'PREVIEW_PICTURE',
            'DETAIL_PICTURE',
            'DETAIL_TEXT',
            'DETAIL_PAGE_URL',
            'IBLOCK_SECTION_ID',
            'PROPERTY_BREND'
        ];

        $res = \CIBlockElement::GetList(['SORT' => 'ASC'], $filter, $arGroupBy, $arNavStartParams, $select);

        $result = [];
        while ($slide = $res->GetNext()) {
            foreach (['img_mob' => 'DETAIL_PICTURE', 'img' => 'PREVIEW_PICTURE'] as $imgType => $imgKey) {
                $slide[$imgType] = $this->getResizeImage(
                    $slide[$imgKey],
                    [
                        'width' => $this->arParams['IMG_RESIZE'][$imgType][0],
                        'height' => $this->arParams['IMG_RESIZE'][$imgType][1],
                    ]
                );
            }

            $result[] = $slide;
        }
        return $result;
    }

    private function getSlideImages($slides, $type)
    {
        $slideImages = array_map(function ($slide) use ($type) {
            return $slide[$type];
        }, $slides);

        return $slideImages;
    }

    private function getIblockId()
    {
        $res = \CIBlock::GetList(
            [],
            [
                'ACTIVE' => 'Y',
                'CODE' => $this->arParams['IBLOCK_CODE']
            ]
        );

        if ($iblock = $res->Fetch()) {
            return $iblock['ID'];
        }

        return false;
    }

    private function getResizeImage($imgId, $params)
    {
        if (isset($params['width'], $params['height']) &&
            ($params['width'] > 0) &&
            ($params['height'] > 0)
        ) {
            return \CFile::ResizeImageGet(
                $imgId,
                $params
            )['src'];
        } else {
            return \CFile::GetPath($imgId);
        }
    }

    private function getSections($arElements) {
        $arSections = [];
        $arSectionsIds = [];
        foreach ($arElements as $arElement) {
            if (empty($arSectionsIds[$arElement['IBLOCK_SECTION_ID']])) {
                $arSectionsIds[$arElement['IBLOCK_SECTION_ID']] = $arElement['IBLOCK_SECTION_ID'];
            }
        }
        if (!empty($arSectionsIds)) {
            $res = \CIBlockSection::GetList(
                [],
                [
                    'IBLOCK_ID' => $this->getIblockId(),
                    'ID' => $arSectionsIds
                ],
                false,
                [
                    'CODE', 'NAME', 'PICTURE', 'SECTION_PAGE_URL', 'UF_BAR_ICON'
                ]
            );
            while ($ob = $res ->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PICTURE'] = \CFile::GetPath($arFields['PICTURE']);
                $arSections[] = $arFields;
            }
        }
        return $arSections;
    }

    private function getBrandData($brandCode) {
        $brandIlockId = \Its\Lib\Iblock::getInstance()->get('brands', SITE_ID);
        $brandData = [];
        if ($brandIlockId !== null) {
            $res = \CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_ID' => $brandIlockId,
                    'CODE' => $brandCode
                ],
                false,
                false,
                [
                    'IBLOCK_ID', 'ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_COUNTRY', 'DETAIL_PAGE_URL'
                ]
            );
            $brandData = $res->GetNext();
            $brandData['PREVIEW_PICTURE'] = \CFile::GetPath($brandData['PREVIEW_PICTURE']);
        }
        if (!empty($brandData['PROPERTY_COUNTRY_VALUE'])) {
            $brandData['COUNTRY'] = \Its\Lib\Utils::getHLClass('Brandcountry')::getList(
                array(
                    'select' => [
                        'UF_NAME', 'UF_FILE'
                    ],
                    'filter' => [
                        'UF_XML_ID' => $brandData['PROPERTY_COUNTRY_VALUE']
                    ],
                    'limit' => 1
                )
            )->fetch();
            $brandData['COUNTRY']['UF_FILE'] = \CFile::GetPath($brandData['COUNTRY']['UF_FILE']);
        }
        return $brandData;
    }

    private function getCategories($arElements) {
        $arCategory = [];
        $arSection = [];
        foreach ($arElements as $arElement) {
            if (empty($arSection[$arElement['IBLOCK_SECTION_ID']])) {
                $arSection[$arElement['IBLOCK_SECTION_ID']] = $arElement['IBLOCK_SECTION_ID'];
            }
            if (empty($arCategory[$arElement['IBLOCK_SECTION_ID']]['BREND_IDS'][$arElement['PROPERTY_BREND_VALUE']])) {
                $arCategory[$arElement['IBLOCK_SECTION_ID']]['BREND_IDS'][$arElement['PROPERTY_BREND_VALUE']] = $arElement['PROPERTY_BREND_VALUE'];
            }
        }
        $res = \CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $this->getIblockId(),
                'ID' => $arSection
            ],
            false,
            [
                'ID', 'NAME'
            ]
        );
        while ($ob = $res ->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arSection[$arFields['ID']] = $arFields['NAME'];
        }
        foreach ($arSection as $id => $name) {
            $arCategory[$id]['NAME'] = $name;
        }
        return $arCategory;
    }
}

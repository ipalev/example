<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Iblock\PropertyTable;
use Its\Lib\BlogParser;

//убираем теги <p> чтоб картинки не оборачивало в блоки абзаца
$arResult['ACTIVE_FROM'] = FormatDate('d F Y', MakeTimeStamp($arResult['ACTIVE_FROM']));
$text = explode('<p>', $arResult['DETAIL_TEXT']);
foreach ($text as $index => &$paragraph) {
    if (strpos($paragraph, '[img1]')) {
        str_replace('</p>', '', $paragraph);
    } elseif (!empty($paragraph)) {
        if ($index == 1) {
            $paragraph = '<p class="first-letter">' . $paragraph;
        } else {
            $paragraph = '<p>' . $paragraph;
        }
    }
}
$arResult['DETAIL_TEXT'] = implode($text);
$snippets = [
    BlogParser::SNIPPET => [
        '[img1]##IMG1##[/img1]' => '<div class="row py-md-30 pt-30 pb-0 its-fade js-observe two-pics"><div class="col-sm-6"><div class="picture">##IMG1##<a class="picture__btn" href="#" data-no-swup></a>',
        '[text_img1]##IMG1TEXT##[/text_img1]' => '<div class="picture__dscr">##IMG1TEXT##</div></div></div>',
        '[img2]##IMG2##[/img2]' => '<div class="col-sm-6"><div class="picture">##IMG2##<a class="picture__btn" href="#" data-no-swup></a>',
        '[text_img2]##IMG2TEXT##[/text_img2]' => '<div class="picture__dscr">##IMG2TEXT##</div></div></div></div>',
        '<p>##CONTENT##</p>' => '<div class="article__content"><p>##CONTENT##</p></div>',
        '<p class="first-letter">##CONTENT##</p>' => '<div class="article__content"><p class="first-letter">##CONTENT##</p></div>',
        '<h4>##CONTENT##</h4>' => '<div class="article__content"><h4 class="article__subtitle">##CONTENT##</h4></div>',
        '<h3>##CONTENT##</h3>' => '<div class="article__content"><h3 class="article__subtitle">##CONTENT##</h3></div>',
        '<h2>##CONTENT##</h2>' => '<div class="article__content"><h2 class="article__subtitle">##CONTENT##</h2></div>',
    ]
];
$text = new BlogParser($snippets, $arResult['DETAIL_TEXT']);
$arResult['DETAIL_TEXT'] = $text -> getLayout();

//Получаем поля товара для паспорта
$arProperties = [];
$CatalogIblockId = \Its\Lib\Iblock::getInstance()->get('catalog');
if ($arResult['PROPERTIES']['PRODUCT']['VALUE'] && $CatalogIblockId !== null) {
    $catalogProperties = PropertyTable::query()
        ->setSelect(['ID'])
        ->where('IBLOCK_ID', $CatalogIblockId)
        ->whereIn('PROPERTY_TYPE', [
            PropertyTable::TYPE_STRING,
            PropertyTable::TYPE_NUMBER,
            PropertyTable::TYPE_LIST,
        ])
        ->whereNull('USER_TYPE', 'HTML')
        ->fetchAll();
    foreach ($catalogProperties as $key => $id) {
        $catalogProperties[$key] = $id['ID'];
    }

    if ($arResult['PROPERTIES']['PRODUCT']['VALUE']) {
        $res = CIBlockElement::GetProperty(
            $CatalogIblockId,
            $arResult['PROPERTIES']['PRODUCT']['VALUE'],
            [],
            [ 'ID' => $catalogProperties, 'EMPTY' => 'N' ]
        );
        while($arProperty = $res->GetNext()) {
            if ($arProperty['PROPERTY_TYPE'] == 'L') {
                $arProperties[$arProperty['NAME']][] = $arProperty['VALUE_ENUM'];
            } else {
                $arProperties[$arProperty['NAME']][] = $arProperty['VALUE'];
            }
        }
    }
}
if ($arProperties) {
    $arResult['PRODUCT_PROPERTIES'] = [];
    foreach ($arProperties as $key => $property) {
        $arResult['PRODUCT_PROPERTIES'][$key] = implode(', ', $property);
    }
}

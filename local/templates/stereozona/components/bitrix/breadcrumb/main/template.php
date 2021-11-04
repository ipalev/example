<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

if(empty($arResult)) return '';

$strReturn = '<div  class="breadcrumbs" >';
$strShemaBreadcrumbList = '';
$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
  $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
  $strReturn .=
    '<a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" >' .
    '    <span >'.$title.'</span>' .
    '</a>';
  $strShemaBreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item"><span itemprop="name">'.$title.'</span><meta itemprop="position" content="'.$index.'"></a></li>';
}

$strReturn .= '</div>';

//for http://schema.org/BreadcrumbList
$strShemaBreadcrumbList = '<div style="display: none">
<ul itemscope itemtype="http://schema.org/BreadcrumbList">'.$strShemaBreadcrumbList.
'</ul></div>';
return $strReturn.$strShemaBreadcrumbList;

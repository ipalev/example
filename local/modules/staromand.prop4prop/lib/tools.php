<?
namespace Staromand\Prop4Prop;

use Bitrix\Iblock\PropertyTable;

class Tools {
    public static function getOptions($arProperty, $values, &$bWasSelect, $isElement = false)
    {
        if(!isset($_REQUEST['IBLOCK_ID']) || $_REQUEST['IBLOCK_ID'] <= 0) return '';

        $options = "";
        $bWasSelect = false;


        $qProps = PropertyTable::query()
            ->where('IBLOCK_ID', intval($_REQUEST['IBLOCK_ID']))
            ->setSelect(['NAME', 'CODE']);

        $onlyLinked = \Bitrix\Main\Config\Option::get('staromand.prop4prop', 'show_only_linked', 'Y');

        if($onlyLinked === 'Y') {
            $sectionID = $isElement ? $_REQUEST['find_section_section'] : $_REQUEST['ID'];
            $sectionPropIDs = \CIBlockSectionPropertyLink::GetArray($_REQUEST['IBLOCK_ID'], $sectionID);

            $qProps->whereIn('ID', array_keys($sectionPropIDs));
        }

        $rsProps = $qProps->exec();

        while($arProp = $rsProps->fetch()) {
            $options .= '<option value="'.$arProp["CODE"].'"';
            if(in_array($arProp["CODE"], $values))
            {
                $options .= ' selected';
                $bWasSelect = true;
            }
            $options .= '>'.$arProp["NAME"].'</option>';
        }

        return  $options;
    }

    public static function PrepareStyle($arProperty)
    {
        if($arProperty["MULTIPLE"] == "Y" && $arProperty["ROW_COUNT"] > 2) {
            $size = 'size="'.$arProperty["ROW_COUNT"].'"';
        } elseif($arProperty["MULTIPLE"] == "Y") {
            $size = 'size="3"';
        } else {
            $size = '';
        }

        return ["size" =>  $size,];
    }
}

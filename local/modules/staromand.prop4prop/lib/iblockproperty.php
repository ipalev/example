<?
namespace Staromand\Prop4Prop;

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class IblockProperty
{
    public static function GetUserTypeDescription()
    {
        return Array(
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "PropIblockProperty",
            "DESCRIPTION" => Loc::getMessage("STAROMAND_PROP4PROP_DESCRIPTION"),
            "GetSettingsHTML" => Array("\\Staromand\\Prop4Prop\\IblockProperty", "GetSettingsHTML"),
            "GetPropertyFieldHtml" => Array("\\Staromand\\Prop4Prop\\IblockProperty", "GetPropertyFieldHtml"),
            "GetPropertyFieldHtmlMulty"	=> Array("\\Staromand\\Prop4Prop\\IblockProperty", "GetPropertyFieldHtmlMulty"),
            //"GetAdminListViewHTML" => Array("\\Staromand\\Prop4Prop\\IblockProperty", "GetAdminListViewHTML"),
            //"GetAdminFilterHTML" => Array("\\Staromand\\Prop4Prop\\IblockProperty", "GetAdminFilterHTML"),
            //"GetPublicViewHTML" => Array("\\Staromand\\Prop4Prop\\IblockProperty", "GetPublicViewHTML"),
        );
    }

    public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        $result = '';
        $arPropertyFields = Array("HIDE" => array("MULTIPLE_CNT", "COL_COUNT", "DEFAULT_VALUE"));

        $result .=
            '<tr>
                <td>'.GetMessage("IBLOCK_PROPERTY_ENTITY_ROW_COUNT_FIELD").':</td>
                <td>
                    <input type="text" name="PROPERTY_ROW_COUNT" size="20"  maxlength="225" value="'.$arProperty['ROW_COUNT'].'">
                </td>
            </tr>';

        return $result;
    }

    function GetPublicViewHTML($arProperty, $value, $strHTMLControlName){}

    function GetAdminFilterHTML($arProperty, $strHTMLControlName){}

    function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName){}

    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $settings = Tools::PrepareStyle($arProperty);
        if($settings["size"] > 1)
            $size = ' size="'.$settings["size"].'"';
        else
            $size = '';

        if($settings["width"] > 0)
            $width = ' style="width:'.$settings["width"].'px"';
        else
            $width = '';

        $bWasSelect = false;
        $options = Tools::getOptions($arProperty, array($value["VALUE"]), $bWasSelect, true);

        $html = '<select name="'.$strHTMLControlName["VALUE"].'"'.$size.$width.'>';
        if($arProperty["IS_REQUIRED"] != "Y")
            $html .= '<option value=""'.(!$bWasSelect? ' selected': '').'>'.Loc::getMessage("IBLOCK_PROP_ELEMENT_LIST_NO_VALUE").'</option>';
        $html .= $options;
        $html .= '</select>';
        return  $html;
    }

    public static function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        $max_n = 0;
        $values = array();
        if(is_array($value))
        {
            foreach($value as $valueNum => $arValue)
            {
                if (is_array($arValue))
                    $values[$valueNum] = $arValue["VALUE"];
                else
                    $values[$valueNum] = $arValue;

                if(preg_match("/^n(\\d+)$/", $valueNum, $match))
                {
                    if($match[1] > $max_n)
                        $max_n = intval($match[1]);
                }
            }
        }

        $settings = Tools::PrepareStyle($arProperty);

        $bWasSelect = false;
        $options = Tools::getOptions($arProperty, $values, $bWasSelect, true);

        $html = '<input type="hidden" name="'.$strHTMLControlName["VALUE"].'[]" value="">';
        $html .= '<select multiple name="'.$strHTMLControlName["VALUE"].'[]" '.$settings['size'].' >';
        if($arProperty["IS_REQUIRED"] != "Y")
            $html .= '<option value=""'.(!$bWasSelect? ' selected': '').'>'.Loc::getMessage("IBLOCK_PROP_ELEMENT_LIST_NO_VALUE").'</option>';
        $html .= $options;
        $html .= '</select>';

        return  $html;
    }
}
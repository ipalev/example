<?
namespace Staromand\Prop4Prop;

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__DIR__ . '/iblockproperty.php');

class UserType
{
    function GetUserTypeDescription()
    {
        return array(
            "USER_TYPE_ID"	=> "prop",
            "CLASS_NAME"	=> "\\Staromand\\Prop4Prop\\UserType",
            "DESCRIPTION"	=> Loc::getMessage("STAROMAND_PROP4PROP_DESCRIPTION"),
            "BASE_TYPE"		=> "string",
        );
    }

    //function OnSearchIndex($arUserField){}

    //function GetFilterHTML($arUserField, $arHtmlControl){}

    //function GetAdminListViewHTML($arUserField, $arHtmlControl){}

    function GetEditFormHTML($arUserField, $arHtmlControl)
    {
        $bWasSelect = false;
        $options = Tools::getOptions($arUserField, [$arHtmlControl['VALUE']], $bWasSelect);

        $html = '<select name="'.$arHtmlControl["NAME"].'">';
        if($arUserField["MANDATORY"] != "Y")
            $html .= '<option value=""'.(!$bWasSelect? ' selected': '').'>'.Loc::getMessage("IBLOCK_PROP_ELEMENT_LIST_NO_VALUE").'</option>';
        $html .= $options;
        $html .= '</select>';
        return  $html;
    }

    function GetEditFormHTMLMulty($arUserField, $arHtmlControl)
    {
        $max_n = 0;
        $values = array();
        if(is_array($arHtmlControl['VALUE']))
        {
            foreach($arHtmlControl['VALUE'] as $valueNum => $arValue)
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

        $bWasSelect = false;
        $options = Tools::getOptions($arUserField, $values, $bWasSelect);

        $html = '<input type="hidden" name="'.$arHtmlControl["NAME"].'" value="">';
        $html .= '<select multiple name="'.$arHtmlControl["NAME"].'" size="10">';
        if($arUserField["MANDATORY"] != "Y")
            $html .= '<option value=""'.(!$bWasSelect? ' selected': '').'>'.Loc::getMessage("IBLOCK_PROP_ELEMENT_LIST_NO_VALUE").'</option>';
        $html .= $options;
        $html .= '</select>';

        return  $html;
    }

    function GetDBColumnType($arUserField)
    {
        global $DB;
        switch(strtolower($DB->type))
        {
            case "mysql":
                return "text";
            case "oracle":
                return "varchar2(2000 char)";
            case "mssql":
                return "varchar(2000)";
        }
    }
}
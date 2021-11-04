<?
namespace Its\CPManager\CustomUF;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use CUserTypeManager as UTM;

Loc::loadMessages(__FILE__);

class Proposal {
    function GetUserTypeDescription(){
        return array(
            "USER_TYPE_ID" => "its_cpm_proposal",
            "CLASS_NAME" => "Its\\CPManager\\CustomUF\\Proposal",
            "DESCRIPTION" => Loc::getMessage("ITS_CPM_CUSTOMUF_PROPOSAL_DESCR"),
            "BASE_TYPE" => UTM::BASE_TYPE_INT,
        );
    }

    function GetEditFormHTML($arUserField, $arHtmlControl){
        return self::GetEditFormHTMLMulty($arUserField, $arHtmlControl);
    }

    function GetEditFormHTMLMulty($arUserField, $arHtmlControl){
        global $USER;

        $proposals = \Its\CPManager\ORM\ProposalTable::query()
            ->setSelect(['NAME'])
            ->where('USER_ID', $USER->GetID())
            ->fetchAll();

        $html = '<select multiple disabled>';
        foreach ($proposals as $arProposal) {
            $html .= '<option>' . $arProposal['NAME'] . '</option>';
        }
        $html .= '</select>';

        return $html;
    }

    function GetDBColumnType($arUserField){
        global $DB;
        switch (strtolower($DB->type)) {
            case "mysql":
                return "text";
            case "oracle":
                return "varchar2(2000 char)";
            case "mssql":
                return "varchar(2000)";
        }
    }
}
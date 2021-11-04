<?php

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'staromand.prop4prop');

if(!$USER->IsAdmin())
    return;

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();
Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

Loader::includeModule('iblock');

$arAllOptions = [
    Loc::getMessage('STAROMAND_PROP4PROP_OPT_HEADER_MAIN'),
    [
        'show_only_linked',
        Loc::getMessage('STAROMAND_PROP4PROP_OPT_ONLY_LINKED'),
        'Y',
        [
            'type' => 'checkbox', 'values' => 'Y'
        ]
    ],
];

$tabControl = new CAdminTabControl("tabControl", array(
    array(
        "DIV" => "edit1",
        "TAB" => Loc::getMessage("MAIN_TAB_SET"),
        "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET"),
    ),
));

if ((!empty($save) || !empty($restore)) && $request->isPost() && check_bitrix_sessid()) {
    if (!empty($save)) {
        foreach ($arAllOptions as $_option) {
            if( !is_array($_option) ) continue;

            switch ($_option[3]['type']) {
                case 'checkbox':
                    $value = $request->getPost($_option[0]) === $_option[3]['values'] ? $_option[3]['values'] : 'N';
                    break;
                case 'selectbox':
                    if($_option[3]['multiple']){
                        $value =
                            is_array($request->getPost($_option[0])) && count(array_diff($request->getPost($_option[0]), $_option[3]['values']['REFERENCE_ID'])) == 0 ?
                                serialize($request->getPost($_option[0])) :
                                $_option[2];
                    } else {
                        $value = in_array($request->getPost($_option[0]), $_option[3]['values']['REFERENCE_ID']) ? $request->getPost($_option[0]) : $_option[2];
                    }
                    break;
            }

            Option::set( ADMIN_MODULE_NAME, $_option[0], $value );
        }
        CAdminMessage::showMessage(array(
            "MESSAGE" => Loc::getMessage('STAROMAND_PROP4PROP_OPT_SAVE'),
            "TYPE" => "OK",
        ));
    } else {
        Option::delete(ADMIN_MODULE_NAME);
        CAdminMessage::showMessage([
            "MESSAGE" => Loc::getMessage("STAROMAND_PROP4PROP_OPT_RESTORE"),
            "TYPE" => "OK",
        ]);
    }
}

$tabControl->begin();
?>

<form name="staromand_prop4prop_options" method="post" action="<?=sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID)?>">
    <?=bitrix_sessid_post();
    $tabControl->beginNextTab();

    foreach ($arAllOptions as $_option) {
        if( !is_array($_option) ){?>
            <tr class="heading">
                <td colspan="2"><b><?=$_option?></b></td>
            </tr>
        <?} else {

            $savedOption = Option::get(ADMIN_MODULE_NAME, $_option[0], $_option[2]);

            switch ($_option[3]['type']) {
                case 'checkbox':
                    $html =
                        InputType('checkbox', $_option[0], 'Y', $savedOption, false, false);
                    break;
                case 'selectbox':
                    $html = $_option[3]['multiple'] ?
                        SelectBoxMFromArray($_option[0].'[]', $_option[3]['values'], unserialize($savedOption), '', false, 10) :
                        SelectBoxFromArray($_option[0], $_option[3]['values'], $savedOption);
                    break;
            }?>

            <tr>
                <td width="50%"><?=$_option[1]?></td>
                <td width="50%"><?=$html?></td>
            </tr>
        <?}
    }

    $tabControl->buttons(); ?>
    <input type="submit"
           name="save"
           value="<?=Loc::getMessage("MAIN_SAVE") ?>"
           title="<?=Loc::getMessage("MAIN_OPT_SAVE_TITLE") ?>"
           class="adm-btn-save"
           />
    <input type="submit"
           name="restore"
           title="<?=Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS") ?>"
           onclick="return confirm('<?= AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING")) ?>')"
           value="<?=Loc::getMessage("MAIN_RESTORE_DEFAULTS") ?>"
           />
    <?$tabControl->end();?>
</form>
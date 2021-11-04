<?php

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'its.spopup');

if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

$tabControl = new CAdminTabControl("tabControl", array(
    array(
        "DIV" => "edit1",
        "TAB" => Loc::getMessage("MAIN_TAB_SET"),
        "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET"),
    ),
));

if ((!empty($save) || !empty($restore)) && $request->isPost() && check_bitrix_sessid()) {
    if (!empty($restore)) {
        Option::delete(ADMIN_MODULE_NAME);
        CAdminMessage::showMessage(array(
            "MESSAGE" => Loc::getMessage("REFERENCES_OPTIONS_RESTORED"),
            "TYPE" => "OK",
        ));
    } elseif ($request->getPost('title')) {
        Option::set(
            ADMIN_MODULE_NAME,
            'title',
            $request->getPost('title')
        );
        Option::set(
            ADMIN_MODULE_NAME,
            'text',
            $request->getPost('text')
        );
        Option::set(
            ADMIN_MODULE_NAME,
            'link',
            $request->getPost('link')
        );
        Option::set(
            ADMIN_MODULE_NAME,
            'sleep',
            $request->getPost('sleep')
        );
        CAdminMessage::showMessage(array(
            "MESSAGE" => Loc::getMessage("REFERENCES_OPTIONS_SAVED"),
            "TYPE" => "OK",
        ));
    } else {
        CAdminMessage::showMessage(Loc::getMessage("REFERENCES_INVALID_VALUE"));
    }
}

$tabControl->begin();
?>

<form method="post" action="<?=sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID)?>">
    <?php
    echo bitrix_sessid_post();
    $tabControl->beginNextTab();
    ?>
    <tr>
        <td width="10%">
            <label for="sections_sort">Заголовок</label>
        <td width="90%">
            <input type="text"
                   size="50"
                   name="title"
                   value="<?=Option::get(ADMIN_MODULE_NAME, 'title', '');?>"
                   />
        </td>
    </tr>
    <tr>
        <td width="10%">
            <label for="sections_sort">Текст</label>
        <td width="90%">
            <textarea type="text"
                   style="width:100%"
                   name="text"
                   value="<?=Option::get(ADMIN_MODULE_NAME, 'text', '');?>"
                   ><?=Option::get(ADMIN_MODULE_NAME, 'text', '');?></textarea>
        </td>
    </tr>
    <tr>
        <td width="10%">
            <label for="sections_sort">Ссылка</label>
        <td width="90%">
            <textarea type="text"
                   name="link"
                   style="width:100%"
                   value="<?=Option::get(ADMIN_MODULE_NAME, 'link', '');?>"
                   ><?=Option::get(ADMIN_MODULE_NAME, 'link', '');?></textarea>
        </td>
    </tr>
    <tr>
        <td width="10%">
            <label for="sections_sort">Через сколько секунд показать</label>
        <td width="90%">
            <input type="text"
                   size="50"
                   name="sleep"
                   value="<?=Option::get(ADMIN_MODULE_NAME, 'sleep', '60');?>"
                   />
        </td>
    </tr>

    <?php
    $tabControl->buttons();
    ?>
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
    <?php
    $tabControl->end();
    ?>
</form>


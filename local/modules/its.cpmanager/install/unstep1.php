<?php

use Bitrix\Main\Localization\Loc;

?>
<form action="<?=$APPLICATION->GetCurPage()?>">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
	<input type="hidden" name="id" value="<?=$Module->MODULE_ID?>">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">
    <?
    CAdminMessage::ShowMessage(Loc::getMessage("ITS_CPM_STEP1_MESSAGE"));
    ?>
	<p><input type="checkbox" name="save_options" id="save_options" value="Y" checked><label for="save_options"><?=Loc::getMessage("ITS_CPM_STEP1_OPTIONS_SAVE")?></label></p>
	<p><input type="checkbox" name="save_tables" id="save_tables" value="Y" checked><label for="save_tables"><?=Loc::getMessage("ITS_CPM_STEP1_TABLES_SAVE")?></label></p>
	<input type="submit" name="inst" value="<?=Loc::getMessage("ITS_CPM_STEP1_DO")?>">
</form>
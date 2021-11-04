<?namespace Its\CPManager\CustomUF;
use Bitrix\Main\UserFieldTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class UserFieldHelper {
    public static function createUserFieldScope(array $fields, array $enumArray) {
        foreach ($fields as $field) {
            $oUserTypeEntity = new \CUserTypeEntity();
            $newId = $oUserTypeEntity->Add($field);

            if(
                $newId
                && $field['USER_TYPE_ID'] == 'enumeration'
                && isset($enumArray[$field['ENTITY_ID']][$field['FIELD_NAME']])
                && is_array($enumArray[$field['ENTITY_ID']][$field['FIELD_NAME']])
            ) {
                $arEnums = [];
                foreach($enumArray[$field['ENTITY_ID']][$field['FIELD_NAME']] as $key => $enumValue) {
                    $arEnums['n' . $key] = $enumValue;
                }

                $obEnum = new \CUserFieldEnum();
                $obEnum->SetEnumValues($newId, $arEnums);
            }
        }
    }

    public static function removeUserFields(array $fields) {
        $entities = array_unique(array_column($fields, 'ENTITY_ID'));
        $fields = UserFieldTable::query()
            ->setSelect(['ID'])
            ->whereIn('ENTITY_ID', $entities)
            ->fetchAll();

        foreach ($fields as $field) {
            $oUserTypeEntity = new \CUserTypeEntity();
            $oUserTypeEntity->Delete($field['ID']);
        }
    }

}
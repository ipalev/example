<?php
namespace Its\CPManager\Controller;

use \Bitrix\Main;
use \Bitrix\Iblock\SectionTable;
use \Bitrix\Main\Engine\Controller;
use \Bitrix\Main\ORM\Fields\Relations\Reference;

use Bitrix\Main\ORM\Objectify\EntityObject;
use \Its\CPManager\Controller\Permission\ActionFilter;
use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\ORM\ProductCategoryTable;
use \Its\CPManager\Utils;

class ProductCategory extends Controller {

    private static $sectionChains = [];

    public function configureActions(){
        return [
            'add' => [
                'prefilters' => [
                    new ActionFilter\CheckPermission(Permission::T_OWNER_WRITE),
                    new ActionFilter\CheckArgument('categoryFields', ['IBLOCK_SECTION_ID']),
                ]
            ],
        ];
    }

    /**
     * @param array $categoryFields
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function addAction(array $categoryFields = []): ?int {
        if(!Main\Loader::includeModule('iblock')) {
            $this->errorCollection[] = new Main\Error('Failed to load \'Iblock\' module');
            return null;
        }

        $section = SectionTable::query()
            ->setSelect(['NAME'])
            ->where('ID', $categoryFields['IBLOCK_SECTION_ID'])
            ->fetch();

        if(!$section) {
            $this->errorCollection[] = new Main\Error('Bitrix doesn\'t have such a section');
            return null;
        }

        $newCategory = ProductCategoryTable::createObject();

        if( !array_key_exists('NAME', $categoryFields) ) {
            $newCategory->set('NAME', $section['NAME']);
        }

        foreach (ProductCategoryTable::getEntity()->getFields() as $field) {
            if( array_key_exists($field->getName(), $categoryFields) && Utils::isAllowedToSet($field) ) {
                $newCategory->set($field->getName(), $categoryFields[$field->getName()]);
            }
        }

        $result = $newCategory->save();

        if(!$result->isSuccess()) {
            $this->errorCollection = $result->getErrorCollection();
            return null;
        }

        return $result->getId();
    }

    public static function getTopSection(int $categoryId): ?array {
        if($categoryId <= 0) return null;

        $topSection = null;
        $parentId = false;

        while($parentId === false || $parentId > 0) {
            $query = SectionTable::query()
                ->setSelect(['*']);

            if($parentId === false) {
                $query->registerRuntimeField(new Reference('CATEGORY',
                    ProductCategoryTable::class,
                    ['=this.ID' => 'ref.IBLOCK_SECTION_ID']
                ))
                ->where('CATEGORY.ID', $categoryId);
            } else {
                $query->where('ID', $parentId);
            }

            if( ($section = $query->fetch()) && is_array($section) ) {
                $topSection = $section;
                $parentId = intval($topSection['IBLOCK_SECTION_ID']);
            } else {
                $parentId = 0;
            }
        }

        return $topSection;
    }

    public static function getSectionChain(int $categoryId): array {
        if($categoryId <= 0) return [];

        $iblockSectionId = SectionTable::query()
            ->setSelect(['ID'])
            ->registerRuntimeField(new Reference('CATEGORY',
                ProductCategoryTable::class,
                ['=this.ID' => 'ref.IBLOCK_SECTION_ID']
            ))
            ->where('CATEGORY.ID', $categoryId)
        ->fetch()['ID'];

        if(!$iblockSectionId) return [];

        $chain = \CIBlockSection::GetNavChain(false, $iblockSectionId, ['CODE', 'ID'], true);

        return is_array($chain) ? $chain : [];
    }

    public static function isInsideSection(int $categoryId, string $sectionCode){
        if(!array_key_exists($categoryId, static::$sectionChains)) {
            $chain = self::getSectionChain($categoryId);
            static::$sectionChains[$categoryId] = $chain;
        }

        return in_array($sectionCode, array_column(static::$sectionChains[$categoryId], 'CODE'));
    }

    public static function isProductBelong (EntityObject $product, array $sectionCode) {
        $section = self::getTopSection($product->getCategoryId());
        return is_array($section) && in_array($section['CODE'], $sectionCode);
    }
}

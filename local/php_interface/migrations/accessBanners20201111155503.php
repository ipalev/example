<?php

namespace Sprint\Migration;


class accessBanners20201111155503 extends Version
{
    protected $description = "Доступ чтение для всех";

    protected $moduleVersion = "3.22.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('banner_main', 'baners');
        $helper->Iblock()->saveGroupPermissions($iblockId, array (
            'administrators' => 'X',
            'everyone' => 'R',
        ));

    }

    public function down()
    {
        //your code ...
    }
}

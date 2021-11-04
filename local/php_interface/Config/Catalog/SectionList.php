<?php

namespace Its\Config\Catalog;

use Its\Config\ComponentAbstract;

class SectionList extends ComponentAbstract
{
    public function getInitialParametersArray(): array
    {
        return include(__DIR__.'/../../../config/components/section.list.php');
    }
}
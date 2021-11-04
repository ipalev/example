<?php

namespace Its\Config\Catalog;

use Its\Config\ComponentAbstract;

class Complex extends ComponentAbstract
{
    public function getInitialParametersArray(): array
    {
        return include(__DIR__.'/../../../config/components/catalog.php');
    }
}
<?php

namespace Its\Config\Catalog;

use Its\Config\ComponentAbstract;

class SmartFilter extends ComponentAbstract
{
    public function getInitialParametersArray(): array
    {
        return include(__DIR__.'/../../../config/components/smartfilter.php');
    }
}
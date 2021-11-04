<?php

namespace Sprint\Migration;


class FormOneClick20201113115945 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.22.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('ONE-CLICK-BUY_FORM_FILLING_CUSTOM', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Заполнена форма "Купить в 1 клик"',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventType('ONE-CLICK-BUY_FORM_FILLING_CUSTOM', array (
  'LID' => 'en',
  'EVENT_TYPE' => 'email',
  'NAME' => 'The "One click buy" form is completed',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
    }

    public function down()
    {
        //your code ...
    }
}

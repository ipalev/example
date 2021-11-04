<?php

namespace Sprint\Migration;


class CallbackForm20201111114752 extends Version
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
        $helper->Event()->saveEventType('CALLBACK-FORM_FORM_FILLING_CUSTOM', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Заполнена форма обратной связи',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventType('CALLBACK-FORM_FORM_FILLING_CUSTOM', array (
  'LID' => 'en',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Callback form is completed',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
    }

    public function down()
    {
        //your code ...
    }
}

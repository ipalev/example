<?php

namespace Sprint\Migration;


class CheaperForm20201111182846 extends Version
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
        $helper->Event()->saveEventType('CHEAPER_FORM_FILLING_CUSTOM', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Заполнена форма "Нашли дешевле"',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventType('CHEAPER_FORM_FILLING_CUSTOM', array (
  'LID' => 'en',
  'EVENT_TYPE' => 'email',
  'NAME' => '"Cheaper" form is completed',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
    }

    public function down()
    {
        //your code ...
    }
}

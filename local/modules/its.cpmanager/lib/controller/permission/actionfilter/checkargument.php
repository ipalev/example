<?php
namespace Its\CPManager\Controller\Permission\ActionFilter;

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;

class CheckArgument extends Main\Engine\ActionFilter\Base{

    private $argumentKeys;
    private $argName;

    public function __construct(string $argName, array $needArgumentKeys){
        $this->argName = $argName;
        $this->argumentKeys = $needArgumentKeys;
		parent::__construct();
	}

	public function onBeforeAction(Main\Event $event){
        $arguments = $this->action->getArguments();

        $notProvided = [];
        foreach($this->argumentKeys as $key) {
            if(!array_key_exists($arguments[$this->argName], $key)) {
                $notProvided[] = $key;
            }
        }

        if(!empty($notProvided)) {

            $this->errorCollection[] =
                new Main\Error(
                    Loc::getMessage('ITS_CPM_ACTIONFILTER_ERROR_NOT_PROVIDED', ['#FIELDS#' => implode(', ', $notProvided)])
                );

			return new Main\EventResult(Main\EventResult::ERROR, null, null, $this);
		}

		return null;
	}
}
<?php

namespace Its\Lib\AjaxApiController;

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Request;
use Bitrix\Main\Result;
use Monolog\Registry;

/**
 * Class AbstractController
 *
 * @property Request $request
 * @property Context $context
 *
 * @package Its\Lib
 */

abstract class AbstractController
{
    protected $request;
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
        $this->request = $context->getRequest();
    }

    public function run(string $action): array
    {
        try{
            $result = $this->callAction($action);
        } catch (\Throwable $e) {
            Registry::getInstance('error')
                ->withName('AbstractController')
                ->error(sprintf('run "%s": %s', $action, $e->getMessage()));

            $result = (new Result())
                ->addError(new Error('Ошибка обработки запроса'));
        }

        return $this->createAnswer($result);
    }

    protected function callAction(string $action): Result
    {
        $methodName = $action.'Action';

        if(method_exists(static::class, $methodName)) {
            return $this->$methodName($this->request->getValues());
        }

        return (new Result())->addError(
            new Error('Недопустимое действие')
        );
    }

    public function createAnswer(Result $result): array
    {
        $answer = [
            'success' => false,
            'message' => '',
        ];

        if ($result->isSuccess()) {
            $answer['success'] = true;
        } else {
            $answer['message'] = implode("\n", $result->getErrorMessages());
        }

        if(!empty($result->getData())) {
            $answer['data'] = $result->getData();
        }

        return $answer;
    }
}

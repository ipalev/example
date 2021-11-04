<?php

namespace Its\Lib\AjaxApiController;

use Bitrix\Main\Loader;
use Bitrix\Main\Result;
use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Sale;
use Bitrix\Sale\BasketBase;
use Bitrix\Catalog\Product\Basket as ProductBasket;
use Bitrix\Sale\Internals\BasketTable;
use Bitrix\Sale\Order;

/**
 * Class Basket
 *
 * @property BasketBase $basket
 * @property array $existingProducts
 * @property array $cartProductMap
 *
 * @package Its\Lib
 */

class Basket extends AbstractController
{
    private $basket;
    private $existingProducts = [];
    private $cartProductMap = [];

    public function __construct(Context $context)
    {
        Loader::includeModule('sale');
        Loader::includeModule('catalog');

        parent::__construct($context);
    }

    public function refreshBasketData(): void
    {
        $this->existingProducts = [];
        $this->cartProductMap= [];

        $this->basket = Sale\Basket::loadItemsForFUser(
            Sale\Fuser::getId(),
            $this->context->getSite()
        );

        foreach($this->basket as $bItem) {
            $this->existingProducts[$bItem->getProductId()] = $bItem->getQuantity();
            $this->cartProductMap[$bItem->getProductId()] = $bItem->getId();
        }
    }

    public function createAnswer(Result $result): array
    {
        $this->refreshBasketData();

        $answer = [
            'STATUS' => 'ERROR',
        ];

        if ($result->isSuccess()) {
            $answer['STATUS'] = 'OK';

            $productId = $this->request->get('id');

            if($productId) $answer['PRODUCT_ID'] = $productId;

            $answer['EXISTING_PRODUCTS'] = $this->existingProducts;
            $answer['REFRESH_BASKET'] = true;

        } else {
            $answer['MESSAGE'] = implode("\n", $result->getErrorMessages());
        }

        return $answer;
    }

    private function decrease(int $id, bool $all, int $quantity = 1): Result
    {
        $this->refreshBasketData();

        $itemInside = array_key_exists($id, $this->cartProductMap);

        if($itemInside) {
            $quantity = 0 >= $quantity ? 1 : $quantity;
            $item2decrease = $this->basket->getItemById($this->cartProductMap[$id]);

            if(!$item2decrease) {
                return (new Result())->addError(
                    new Error('Ошибка получения товара')
                );
            }

            if($all) {
                $item2decrease->delete();
            } else {
                $newQuantity = $item2decrease->getQuantity() - $quantity;
                $item2decrease->setField('QUANTITY', $all || $newQuantity < 0 ? 0 : $newQuantity);
            }

            return $this->basket->save();
        }

        return (new Result())->addError(
            new Error('Элемент не найден')
        );
    }

    protected function increaseAction (array $data): Result
    {
        $quantity = (int) $data['quantity'];
        $delay = $data['delay'] ? 'Y' : 'N';
        $props = [];
        if ($delay == 'Y') {
            $props[] = [ 'NAME' => 'Избранное', 'CODE' => 'FAVOURITE', 'VALUE' => 'Y', 'SORT' => 100 ];
        }

        $isHaveProductPrice = function($productId) {
            $productPrice = \Bitrix\Catalog\PriceTable::getList([
                'select' => ['ID'],
                'filter' => [
                    '=PRODUCT_ID' => $productId,
                ],
                'order' => ['CATALOG_GROUP_ID' => 'ASC']
            ])->fetch();

            return  $productPrice ? true : false;
        };

        $addZeroPrice = function($productId) {
            $fields = Array(
                'PRODUCT_ID' => $productId,
                'CATALOG_GROUP_ID' => 1,
                'PRICE' => 0,
                'CURRENCY' => 'RUB',
            );

            return \Bitrix\Catalog\Model\Price::add($fields);
        };
        !$isHaveProductPrice($data['id']) ? $addZeroPrice($data['id']) : null;

        return ProductBasket::addProduct([
            'PRODUCT_ID' => $data['id'],
            'QUANTITY' => $quantity <= 0 ? 1 : $quantity,
            'DELAY' => $delay,
            'PROPS' => $props,
        ]);
    }

    protected function decreaseAction (array $data): Result
    {
        return $this->decrease((int) $data['id'], false, (int) $data['quantity']);
    }

    protected function removeAction (array $data): Result
    {
        return $this->decrease((int) $data['id'], true);
    }

    protected function clearAction (array $data): Result
    {
        $this->refreshBasketData();

        foreach ($this->basket as $item) {
            if ($item->getField('DELAY') !== 'Y') {
                $item->delete();
            }
        }

        return $this->basket->save();
    }

    protected function getAction (array $data): Result
    {
        $this->refreshBasketData();
    }

    protected function repeatOrderAction (array $data): Result
    {
        global $USER;
        $result = new Result();

        /** @var Order $order */
        if(
            !($order = Order::load((int) $data['order_id']))
            || $USER->GetID() != $order->getUserId()
        ) {
            $result->addError(new Error('Не удалось найти заказ или у Вас недостаточно прав для его просмотра'));
            return $result;
        }

        foreach ($order->getBasket() as $basketItem) {
                $fields = [
                    'PRODUCT_ID' => $basketItem->getProductId(),
                    'QUANTITY' => $basketItem->getQuantity(),
                ];

                $result = ProductBasket::addProduct($fields);

                if (!$result->isSuccess()) {
                    $result->addErrors($result->getErrors());
                }
            }

        return $result;
    }

    public static function getDeferredProducts() {
        $productIds = [];
        $res = BasketTable::query()
            ->setSelect(['PRODUCT_ID'])
            ->where("FUSER_ID", \CSaleBasket::GetBasketUserID())
            ->where('DELAY', 'Y')
            ->where('ORDER_ID', null)
            ->where('LID', SITE_ID)
            ->fetchAll();
        foreach ($res as $arId) {
            $productIds[] = $arId['PRODUCT_ID'];
        }
        return $productIds;
    }
}
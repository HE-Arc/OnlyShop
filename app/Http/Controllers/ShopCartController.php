<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\ShopCart;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.4.0
this file is used for : linking the shopcart model with the shopcart vue. It alo links the shopcart model with the main page vue.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class ShopCartController extends BaseController
{

    /**
     * @api {post} /api/shopcarts Add new user's shopcart to the database. This function is called when a new user is created.
     * @apiName storeShopCart
     * @apiGroup ShopCart
     *
     * @apiParam {number} user_id The id of the user.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function storeShopCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric|min:1',
        ]);

        $shopcart = new ShopCart();
        $shopcart->user_id = $request->user_id;
        $shopcart->save();

        return $this->sendResponse($shopcart, 'Shopcart created successfully.');
    }

    /**
     * @api {get} /api/shopcarts/:id Get the shopcart of a user
     * @apiName getShopCart
     * @apiGroup ShopCart
     *
     * @apiParam {number} id The id of the user.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function getShopCart(Request $request)
    {
        $shopcart = ShopCart::where("user_id", $request->id)->first();

        return $this->sendResponse($shopcart, 'Shopcart found successfully.');
    }

    /**
     * @api {post} /api/shopcarts/addItem Add an item to the shopcart of a user
     * @apiName addItem
     * @apiGroup ShopCart
     *
     * @apiParam {number} id The id of the user.
     * @apiParam {number} item_id The id of the item.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|min:1',
            'item_id' => 'required|numeric|min:1',
        ]);

        $shopcart = ShopCart::where("user_id", $request->id)->first();
        //if shopcart is empty, create a new one
        if ($shopcart == null) {
            $shopcart = new ShopCart();
            $shopcart->user_id = $request->id;
            $shopcart->save();
        }
        $shopcart->items()->attach($request->item_id);

        return $this->sendResponse($shopcart, 'Item added to shopcart successfully.');
    }

    //get the id of the items of the user that are in the shopcart
    public function getAllItemsInShopCart($id)
    {

        $shopcart = ShopCart::where("user_id", $id)->first();
        //if shopcart is empty, return empty array
        if ($shopcart == null) {
            return $this->sendResponse([], 0);
        }
        $items = $shopcart->items()->get();

        $items = $items->map(function ($item) {
            return $item->pivot->item_id;
        });

        //from the id of the items, get the items
        $items = $items->map(function ($item) {
            return \App\Models\Item::where("id", $item)->first();
        });

        //from the items, get the id, name, price
        $items = $items->map(function ($item) {
            return [
                "id" => $item->id,
                "name" => $item->name,
                "price" => $item->price,
            ];
        });

        //get the total price of the items
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item["price"];
        }

        return $this->sendResponse($items, $totalPrice);
    }
}

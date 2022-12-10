<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\ShopCart;
use Illuminate\Support\Facades\Validator;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.2.0
this file is used for : linking the shopcart model with the shopcart vue. It alo links the shopcart model with the main page vue.

Wrote by : Miguel Moreira
updated by : Miguel Moreira, Rui Marco Loureiro
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
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function storeShopCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric|min:1',
        ]);

        $shopcart = new ShopCart();
        $shopcart->user_id = $request->user_id;
        $shopcart->save();

        return response()->json(
            [
                'message' => 'Shopcart added successfully',
                'status' => "success"
            ]
        );
    }

    /**
     * @api {get} /api/shopcarts/:id Get the shopcart of a user
     * @apiName getShopCart
     * @apiGroup ShopCart
     *
     * @apiParam {number} id The id of the user.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Object[]} data The data of the request.
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
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|min:1',
            'item_id' => 'required|numeric|min:1',
        ]);

        $shopcart = ShopCart::where("user_id", $request->id)->first();
        $shopcart->items()->attach($request->item_id);

        return response()->json(
            [
                'message' => 'Item added successfully',
                'status' => "success"
            ]
        );

    }
}

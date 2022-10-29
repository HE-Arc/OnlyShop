<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopCart;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.2.0
this file is used for : linking the shopcart model with the shopcart vue. It alo links the shopcart model with the main page vue.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class ShopCartController extends Controller
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
        $validated = $request->validate([
            'user_id' => 'required|numeric',
        ]);

        if($validated)
        {
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
        else
        {
            return response()->json(
                [
                    'message' => 'Shopcart not added',
                    'status' => "error"
                ]
            );
        }
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
    public function getShopCart($id)
    {
        $shopcart = ShopCart::where("user_id", $id)->first();

        return response()->json(
            [
                'message' => 'ShopCart found successfully',
                'status' => "success",
                'data' => $shopcart
            ]
        );
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
        $validated = $request->validate([
            'id' => 'required|numeric',
            'item_id' => 'required|numeric',
        ]);

        if($validated)
        {
            $shopcart = ShopCart::where("user_id", $request->id)->first();
            $shopcart->items()->attach($request->item_id);

            return response()->json(
                [
                    'message' => 'Item added successfully',
                    'status' => "success"
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'message' => 'Item not added',
                    'status' => "error"
                ]
            );
        }
    }
}

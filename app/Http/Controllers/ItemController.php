<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : linking the item model with the main page vue. It also links the item model with the shopcart, the "my articles" and the item's informations vues.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class ItemController extends Controller
{
    /**
     * @api {get} /api/items Get all items
     * @apiName index
     * @apiGroup Item
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Object[]} data The data of the request.
     */
    public function index()
    {
        $items = Item::all();

        return response()->json(
            [
                'message' => 'Items found successfully',
                'status' => "success",
                'data' => $items
            ]
        );
    }

    /**
     * @api {post} /api/items Add new item to the database
     * @apiName store
     * @apiGroup Item
     *
     * @apiParam {String} name The name of the item.
     * @apiParam {Number} price The price of the item.
     * @apiParam {String} description The description of the item.
     * @apiParam {Number} user_id The id of the user that is selling the item.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:1',
            'price' => 'required|double|min:0',
            'description' => 'required|string|max:1000|min:1',
            'user_id' => 'required|numeric',
        ]);

        if($validated)
        {
            $item = new Item();
            $item->name = $request->name;
            $item->price = $request->price;
            $item->description = $request->description;
            $item->user_id = $request->user_id;
            $item->save();

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

    /**
     * @api {get} /api/items/:id Get an item
     * @apiName show
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the item to get.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Object} data The data of the request.
     */
    public function show($id)
    {
        $item = Item::find($id);

        return response()->json(
            [
                'message' => 'Item found successfully',
                'status' => "success",
                'data' => $item
            ]
        );
    }

    /**
     * @api {update} /api/items/:id Update an item
     * @apiName update
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the item to update.
     * @apiParam {String} name The name of the item.
     * @apiParam {number} price The price of the item.
     * @apiParam {String} description The description of the item.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:1',
            'price' => 'required|double|min:0',
            'description' => 'required|string|max:1000|min:1',
            'user_id' => 'required|numeric',
        ]);

        if($validated)
        {
            $item = Item::find($request->id);
            $item->name = $request->name;
            $item->price = $request->price;
            $item->description = $request->description;
            $item->user_id = $request->user_id;
            $item->save();

            return response()->json(
                [
                    'message' => 'Item updated successfully',
                    'status' => "success"
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'message' => 'Item not updated',
                    'status' => "error"
                ]
            );
        }
    }

    /**
     * @api {delete} /api/items/:id delete an item from the database
     * @apiName destroy
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the item to delete.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function destroy($id)
    {
        Item::destroy($id);

        return response()->json(
            [
                'message' => 'Item deleted successfully',
                'status' => "success"
            ]
        );
    }

    /**
     * @api {get} /api/items/getUserItems/:id Get all items of a user
     * @apiName getUserItems
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the user to get the items from.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Object[]} data The data of the request.
     */
    public function getUserItems($id)
    {
        $items = Item::where("user_id", $id)->get();

        return response()->json(
            [
                'message' => 'Items found successfully',
                'status' => "success",
                'data' => $items
            ]
        );
    }
}

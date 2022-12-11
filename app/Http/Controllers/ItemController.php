<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;
use App\Models\Item;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.4.0
this file is used for : linking the item model with the main page vue. It also links the item model with the shopcart, the "my articles" and the item's informations vues.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class ItemController extends BaseController
{
    /**
     * @api {get} /api/items Get all items
     * @apiName index
     * @apiGroup Item
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function index()
    {
        $items = Item::all();

        return $this->sendResponse(ItemResource::collection($items), 'Items found successfully.');
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
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            'user_id' => 'required|numeric|min:1',
        ]);

        $item = Item::create($request->all());
        return $this->sendResponse(new ItemResource($item), 'Item created successfully.');
    }

    /**
     * @api {get} /api/items/:id Get an item
     * @apiName show
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the item to get.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function show($id)
    {
        $item = Item::find($id);

        return $this->sendResponse(new ItemResource($item), 'Item found successfully.');
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
     * @apiParam {number} user_id The id of the user that is selling the item.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrfail($id);

        $request->validate([
            'name' => 'required|string|max:255|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000|min:1',
            'user_id' => 'required|numeric|min:1',
        ]);

        $item->update($request->all());

        return $this->sendResponse(new ItemResource($item), 'Item updated successfully.');
    }

    /**
     * @api {delete} /api/items/:id delete an item from the database
     * @apiName destroy
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the item to delete.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function destroy($id)
    {
        $item = Item::findOrfail($id);

        $item->delete();
        return $this->sendResponse([], 'Item deleted successfully.');
    }

    /**
     * @api {get} /api/items/getUserItems/:user_id Get all items of a user
     * @apiName getUserItems
     * @apiGroup Item
     *
     * @apiParam {number} id The id of the user to get the items from.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function getUserItems(Request $request)
    {
        $items = Item::where("user_id", $request->user_id)->get();

        return $this->sendResponse(ItemResource::collection($items), 'Items found successfully.');
    }
}

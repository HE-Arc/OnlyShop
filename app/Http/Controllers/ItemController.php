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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("app", [
            "items" => Item::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("items.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->save();
        return redirect()->route("items.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("items.show", [
            "item" => Item::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("items.edit", [
            "item" => Item::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->save();
        return redirect()->route("items.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route("items.index");
    }

    /**
     * Return items of an user
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function userItems($id)
    {
        return view("items.userItems", [
            "items" => Item::where("user_id", $id)->get()
        ]);
    }
}

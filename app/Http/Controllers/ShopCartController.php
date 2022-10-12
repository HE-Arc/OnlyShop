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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("shopcarts.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a shopcart when a user is created
     *
     * @param int $id
     */
    public function storeShopCart($id)
    {
        $shopcart = new ShopCart();
        $shopcart->user_id = $id;
        $shopcart->save();

        return "ShopCart created";
    }

    /**
     * Get the shopcart of a user
     *
     * @param int $id
     */
    public function getShopCart($id)
    {
        $shopcart = ShopCart::where("user_id", $id)->first();
        return $shopcart;
    }

    /**
     * Add an item to the shopcart
     *
     * @param int $id
     * @param int $item_id
     */
    public function addItem($id, $item_id)
    {
        $shopcart = ShopCart::where("user_id", $id)->first();
        $shopcart->items()->attach($item_id);
        return "Item added to shopcart";
    }
}

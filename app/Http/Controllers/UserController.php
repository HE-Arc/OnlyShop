<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shopcart;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : linking the user model with the login and new account vues.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->password = $request->password;
        $confirmPassword = $request->confirmPassword;
        if ($user->password == $confirmPassword)
        {
            $user->save();
            ShopCart::storeShopCart($user->id);
            return redirect()->route("users.index")->with("success", "User and his ShopCart created successfully");
        }
        else
        {
            return redirect()->route("users.create")->with("error", "Password and confirm password do not match");
        }
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
     * Display the login form.
     *
     */
    public function login()
    {
        return view("users.login");
    }

    /**
     * Login the user.
     *
     */
    public function loginSubmit(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where("email", $email)->first();
        if ($user)
        {
            if ($user->password == $password)
            {
                $request->session()->put("user", $user);
                return redirect()->route("products.index")->with("success", "Login successful");
            }
            else
            {
                return redirect()->route("users.login")->with("error", "Password is incorrect");
            }
        }
        else
        {
            return redirect()->route("users.login")->with("error", "User not found");
        }

    }
}

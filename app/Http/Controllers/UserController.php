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
     * @api {post} /api/users Create a new user and his shopcart
     * @apiName store
     * @apiGroup Usere
     *
     * @apiParam {String} lastname The lastname of the user.
     * @apiParam {String} firstname The firstname of the user.
     * @apiParam {String} email The email of the user.
     * @apiParam {String} password The password of the user.
     * @apiParam {String} confirmPassword The password confirmation of the user.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
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

            return response()->json(
                [
                    'message' => 'User and his shopcart created successfully',
                    'status' => "success"
                ]
            );
        }
    }

    /**
     * @api {post} /api/users/login Login a user
     * @apiName login
     * @apiGroup User
     *
     * @apiParam {String} email The email of the user.
     * @apiParam {String} password The password of the user.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Object[]} data The data of the request.
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where("email", $email)->first();
        if ($user)
        {
            if ($user->password == $password)
            {
                return response()->json(
                    [
                        'message' => 'User logged in successfully',
                        'status' => "success",
                        'data' => $user
                    ]
                );
            }
        }

    }
}

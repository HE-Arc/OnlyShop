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
     * @apiGroup User
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
        $validated = $request->validate([
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'confirmPassword' => 'required|string',
        ]);


        if($validated)
        {
            if($request->password == $request->confirmPassword)
            {
                $user = new User();
                $user->lastname = $request->lastname;
                $user->firstname = $request->firstname;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->save();

                $shopcart = new Shopcart();
                $shopcart->id = $user->id;
                $shopcart->save();

                return response()->json(
                    [
                        'message' => 'User added successfully',
                        'status' => "success"
                    ]
                );
            }
            else
            {
                return response()->json(
                    [
                        'message' => 'Passwords do not match',
                        'status' => "error"
                    ]
                );
            }
        }
        else
        {
            return response()->json(
                [
                    'message' => 'User not added',
                    'status' => "error"
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
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if($validated)
        {
            $user = User::where('email', $request->email)->first();

            if($user)
            {
                if($user->password == $request->password)
                {
                    return response()->json(
                        [
                            'message' => 'User logged in successfully',
                            'status' => "success",
                            'data' => $user
                        ]
                    );
                }
                else
                {
                    return response()->json(
                        [
                            'message' => 'Wrong password',
                            'status' => "error"
                        ]
                    );
                }
            }
            else
            {
                return response()->json(
                    [
                        'message' => 'User not found',
                        'status' => "error"
                    ]
                );
            }
        }
        else
        {
            return response()->json(
                [
                    'message' => 'User not logged in',
                    'status' => "error"
                ]
            );
        }
    }
}

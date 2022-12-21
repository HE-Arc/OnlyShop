<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopcart;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.2.0
this file is used for : linking the user model with the login and new account vues.

Wrote by : Rui Marco Loureiro
updated by : Miguel Moreira
*/

class AuthentificationController extends BaseController

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
     * @apiParam {String} password_confirmation The password confirmation of the user.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'c_password' => 'required|same:password',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $shopcart = new Shopcart();
        $shopcart->user_id = $user->id;
        $shopcart->save();

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * @api {post} /api/users/login Login a user
     * @apiName login
     * @apiGroup User
     *
     * @apiParam {String} email The email of the user.
     * @apiParam {String} password The password of the user.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     *
     * @apiFailure {boolean} success The success of the request.
     * @apiFailure {String} message The message of the request.
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();

            $token_split = $user->createToken('MyApp')->plainTextToken;
            $token_split = explode('|', $token_split)[1];

            $success['token'] =  $token_split;
            $success['name'] =  $user->firstname;
            $success['id'] =  $user->id;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * @api {post} /api/users/logout Logout a user
     * @apiName logout
     * @apiGroup User
     *
     * @apiParam {String} email The email of the user.
     *
     * @apiSuccess {boolean} success The success of the request.
     * @apiSuccess {Object[]} data The data of the request.
     * @apiSuccess {String} message The message of the request.
     */
    public function logout(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        $user->tokens()->delete();

        return $this->sendResponse($user, 'User logout successfully.');
    }
}

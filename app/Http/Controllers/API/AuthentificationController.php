<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : linking the user model with the login and new account vues.

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
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
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->firstname;

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
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Object[]} data The data of the request.
     */

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->firstname;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }


    public function logout(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        $user->tokens()->delete();

        return response()->json(
            [
                'message' => 'User logged out successfully',
                'status' => 'success',
            ]
        );
    }
}

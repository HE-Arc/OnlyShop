<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shopcart;
use Illuminate\Support\Facades\Validator;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.3.0
this file is used for : linking the user model with the login and new account vues.

Wrote by : Miguel Moreira
updated by : Rui Marco Loureiro
*/

class UserController extends BaseController
{
    //TODO if needed

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}

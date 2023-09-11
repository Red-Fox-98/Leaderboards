<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $listUsers = User::all();
        return responder()->success($listUsers, new UserTransformer())->respond();
    }
}

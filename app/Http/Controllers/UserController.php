<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getRolByUser()
    {
        $userId = auth()->user()->id;

        $userRoles = User::find($userId)->roles->toArray();
    
        return $userRoles;
    }
}

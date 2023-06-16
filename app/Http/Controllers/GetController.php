<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function getUsers() {
        return User::get();
    }
    public function loginUser() {
        return view('loginUser');
    }
}

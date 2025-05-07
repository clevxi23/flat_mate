<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;

class UserController extends Controller
{
    public function index()
    {
        $users = Account::all();
        return view('website.admin.users', compact('users'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();

        // dd($users);
        return view('backend.user.index', compact('users'));
    }
}

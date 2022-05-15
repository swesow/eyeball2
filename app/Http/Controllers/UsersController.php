<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index() {
        return view('user.index');
    }

    public function fetchAll() {
        $users = User::orderBy('created_at', 'DESC')->get();

        return [
            'users' => $users
        ];
    }

    public function fetch($user_id) {
        $user = User::find($user_id);

        return [
            'user' => $user
        ];
    }

    public function create() {
        return view('user.form');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);


        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->user_type = 'agent';

        $user->save();

        return $user;
    }

    public function edit($user_id) {
        return view('user.form')->with('user_id', $user_id);
    }

    public function update(Request $request, $user_id) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::find($user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        $user->save();

        return $user;
    }

    public function destroy($user_id) {
        $user = User::find($user_id);

        $user->delete();

        return [
            'message' => 'User Deleted'
        ];
    }
}

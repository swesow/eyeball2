<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $loginsSuccess = auth()->attempt($request->only('username', 'password'));

        if (!$loginsSuccess) {
            return back()->with('status', 'Invalid Login Details');
        }

        return redirect()->route('clients.index');
    }

    public function username()
    {
        return 'username';
    }
}

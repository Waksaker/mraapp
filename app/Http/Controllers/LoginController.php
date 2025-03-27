<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function showlogin() {
        return view('welcome');
    }
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('mra_staff')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($user) {
            session(['user_ic' => $user->icno]); // Simpan IC dalam session
            return redirect()->route('showdash');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

}

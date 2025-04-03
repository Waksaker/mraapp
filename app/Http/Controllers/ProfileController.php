<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function viewprofile() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        return view('profile', [
            'user' => $user
        ]);
    }
}

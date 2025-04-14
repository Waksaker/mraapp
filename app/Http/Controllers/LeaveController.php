<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class LeaveController extends Controller
{
    public function showleave() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        $leave = DB::table('mra_leave')
                ->where('noic', $ic)
                ->get()
                ->map(function ($item, $index) {
                    $item->index = $index + 1; // Tambahkan indeks bermula dari 1
                    return $item;
                });
        return view('leave', [
            'user' => $user,
            'leave' => $leave
        ]);
    }

    public function deleteleave($id)
    {
        $delete = DB::table('mra_leave')->where('leaveid', $id)->delete();
        if ($delete) {
            return redirect()->route('showleave');
        }
    }

}

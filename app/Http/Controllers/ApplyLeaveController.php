<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplyLeaveController extends Controller
{
    public function showapplyleave() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        $date = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d');
        return view('applyleave', [
            'user' => $user,
            'date' => $date
        ]);
    }

    public function applyleave(Request $request) {
        // Validasi input
        $request->validate([
            'dateapply' => 'required|date',
            'nameapply' => 'required|string|max:255',
            'noic' => 'required|string|max:12',
            'position' => 'required|string|max:255',
            'datestart' => 'required|date|after_or_equal:dateapply',
            'dateend' => 'required|date|after_or_equal:datestart',
            'daysleave' => 'required|integer|min:1',
            'purpose' => 'required|string|max:500',
            'contactno' => 'required|string|max:15',
            'matters' => 'nullable|string|max:500',
        ]);

        // Pastikan sesi pengguna wujud
        $ic = session('user_ic');
        if (!$ic) {
            return response()->json(['error' => 'Sesi tidak sah!'], 401);
        }

        // Dapatkan maklumat pengguna
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak dijumpai!'], 404);
        }

        // Masukkan data cuti ke dalam database
        $insertleave = DB::table('mra_leave')->insertGetId([
            'dateapply' => $request->dateapply,
            'nameapply' => $request->nameapply,
            'noic' => $request->noic,
            'position' => $request->position,
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'daysleave' => $request->daysleave,
            'purpose' => $request->purpose,
            'contactno' => $request->contactno,
            'matters' => $request->matters
        ]);

        if (!$insertleave) {
            return response()->json(['error' => 'Gagal menyimpan ke database!'], 500);
        }

        // Ambil semula data cuti termasuk yang baru ditambah
        $leave = DB::table('mra_leave')
            ->where('noic', $ic)
            ->get()
            ->map(function ($item, $index) {
                $item->index = $index + 1;
                return $item;
            });

        return view('leave', [
            'user' => $user,
            'leave' => $leave
        ]);
    }
}

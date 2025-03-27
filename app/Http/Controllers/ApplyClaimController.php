<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplyClaimController extends Controller
{
    public function showapplyclaim() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        $date = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d');
        return view('applyclaim', [
            'user' => $user,
            'date' => $date
        ]);
    }

    public function applyclaims(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'purpose' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'amount' => 'nullable|string|max:500',
            'noic' => 'required|string|max:12',
        ]);

        // Periksa sesi
        $ic = session('user_ic');
        if (!$ic) {
            return response()->json(['error' => 'Sesi tidak sah!'], 401);
        }

        // Periksa pengguna dalam DB
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak dijumpai!'], 404);
        }

        // Masukkan data
        $inserted = DB::table('mra_claims')->insert([
            'date' => $request->date,
            'purpose' => $request->purpose,
            'details' => $request->details,
            'amount' => $request->amount,
            'noic' => $request->noic
        ]);

        if (!$inserted) {
            return response()->json(['error' => 'Gagal menyimpan ke database!'], 500);
        }

        $date = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d');

        // Redirect ke halaman dengan mesej berjaya
        return view('claim', [
            'user' => $user
        ]);
    }
}

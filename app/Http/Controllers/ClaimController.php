<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ClaimController extends Controller
{
    public function showclaim() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        return view('claim', [
            'user' => $user
        ]);
    }

    public function getClaims(Request $request)
    {
        $year = $request->tahun;
        $month = $request->bulan;
        $noic = $request->ic;

        $claims = DB::table('mra_staff')
            ->join('mra_claims', 'mra_staff.icno', '=', 'mra_claims.noic')
            ->where('mra_claims.noic', $noic)
            ->whereYear('mra_claims.date', $year)
            ->whereMonth('mra_claims.date', $month)
            ->select('mra_claims.*', 'mra_staff.name')
            ->get();

            return view('partials.claimtable', [
                'claims' => $claims
            ]);
    }
}

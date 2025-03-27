<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplyAttanController extends Controller
{
    public function showapplyattan() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        $date = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d');
        $alluser = DB::table('mra_staff')->select('name')->get();
        return view('applyattan', [
            'user' => $user,
            'date' => $date,
            'allusr' => $alluser
        ]);
    }

    public function applyattan(Request $request) {
        $ic = session('user_ic');
        if (!$ic) {
            return response()->json(['error' => 'Sesi tidak sah!'], 401);
        }

        if ($request->present == 'outstation') {
            $sql = DB::table('mra_outstation')->insert([
                'name' => $request->name_staff,
                'ic'  => $ic,
                'datestart' => $request->datestart,
                'purpose' => $request->purpose_outstation,
                'details' => $request->details_outstation,
                'dateapply'=> $request->date
            ]);

            $sql = DB::table('mra_claims')->insert([
                'date' => $request->datestart,
                'purpose' => $request->purpose_wfh,
                'details' => $request->details_wfh,
                'amount' => $request->amount,
                'noic' => $ic
            ]);
        } elseif ($request->present == 'wfh') {
            $sql = DB::table('mra_wfh')->insert([
                'name' => $request->name_staff,
                'ic' => $ic,
                'purpose' => $request->purpose_wfh,
                'details' => $request->details_wfh,
                'datesign' => $request->datesign,
                'dateapply' => $request->date
            ]);
        }
        if (!$sql) {
            return response()->json(['error' => 'Gagal menyimpan ke database!'], 500);
        }

        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        return view('attan', [
            'user' => $user
        ]);
    }
}

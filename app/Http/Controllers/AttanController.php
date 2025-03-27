<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AttanController extends Controller
{
    public function showattan() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        return view('attan', [
            'user' => $user
        ]);
    }

    public function getattans(Request $request) {
        $year = $request->tahun;
        $month = $request->bulan;
        $noic = $request->ic;
        $attan = $request->attan;

        $office = DB::table('mra_office')
                ->leftJoin('mra_staff', 'mra_office.ic', '=', 'mra_staff.icno')
                ->where('mra_office.ic', $noic)
                ->whereYear('mra_office.date_apply', $year)
                ->whereMonth('mra_office.date_apply', $month)
                ->select('mra_office.id as id', 'mra_staff.name as name', 'mra_office.ic as ic', 'mra_office.inoffice as inoffice', 'mra_office.outoffice as outoffice', 'mra_office.date_apply as date_apply', 'mra_office.updated_at as updated_at')
                ->get();

        $outstation = DB::table('mra_staff')
                    ->leftJoin('mra_outstation', 'mra_staff.icno', '=', 'mra_outstation.ic')
                    ->where('mra_staff.icno', $noic)
                    ->whereYear('mra_outstation.datestart', $year)
                    ->whereMonth('mra_outstation.datestart', $month)
                    ->get();


        $wfh = DB::table('mra_staff')
            ->leftJoin('mra_wfh', 'mra_staff.icno', '=', 'mra_wfh.ic')
            ->where('mra_staff.icno', $noic)
            ->whereYear('mra_wfh.datesign', $year)
            ->whereMonth('mra_wfh.datesign', $month)
            ->select('mra_wfh.id as id', 'mra_wfh.name as name', 'mra_wfh.ic as ic', 'mra_wfh.purpose as purpose', 'mra_wfh.details as details', 'mra_wfh.datesign as datesign', 'mra_wfh.dateapply as dateapply')
            ->get();

        // dd($outstation);

        return view('partials.attantable', [
            'offices' => $office,
            'outstations' => $outstation,
            'wfhs' => $wfh,
            'attan' => $attan
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showdash() {
        $ic = session('user_ic'); // Ambil IC dari session
        $Year_now = date('Y');

        if (!$ic) {
            return redirect()->route('showlogin')->withErrors(['error' => 'Session expired. Please login again.']);
        }

        // Query jumlah cuti mengikut jenis
        $leaveTypes = ["ANNUAL LEAVE", "MEDICAL LEAVE", "UNPAID LEAVE", "METERNITY LEAVE", "HOSPITALITY LEAVE", "EMERGENCY LEAVE"];
        $bulan = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];

        $leaveData = DB::table('mra_leave')
            ->select(DB::raw("matters, COUNT(*) as total"))
            ->where('noic', $ic)
            ->whereIn('matters', $leaveTypes)
            ->groupBy('matters')
            ->pluck('total', 'matters')->toArray();

        // Pastikan semua jenis cuti mempunyai nilai, jika tiada setkan 0
        $leaveCounts = [];
        foreach ($leaveTypes as $type) {
            $leaveCounts[] = $leaveData[$type] ?? 0;
        }

        $claims = DB::table('mra_claims')
                ->selectRaw('MONTH(date) as month, SUM(amount) as total')
                ->where('noic', $ic)
                ->whereYear('date', $Year_now)
                ->groupByRaw('MONTH(date)')
                ->pluck('total', 'month')->toArray();

        // Pastikan semua bulan ada nilai, jika tiada setkan 0
        $jumlah_claim = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlah_claim[] = $claims[$i] ?? 0;
        }

        // Format data dalam JSON
        $claim = [
            "jumlah_claim" => $jumlah_claim
        ];

        $attendance = DB::table('mra_office')
                    ->selectRaw("MONTH(date_apply) as month, COUNT(*) as total")
                    ->whereYear('date_apply', $Year_now)
                    ->where('ic', $ic)
                    ->groupBy('month')
                    ->pluck('total', 'month')
                    ->toArray();

        // Pastikan semua bulan ada, jika tiada data, set ke 0
        $jumlahAttan = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlahAttan[] = $attendance[$i] ?? 0;
        }

        // Gabungkan dalam array
        $attan = [
            "jumlah_attan" => $jumlahAttan
        ];

        $outstation = DB::table('mra_outstation')
                    ->selectRaw("MONTH(datestart) as month, COUNT(datestart) as total")
                    ->whereYear('dateapply', $Year_now)
                    ->where('ic', $ic)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray();

        $jumlah_out = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlah_out[] = $outstation[$i] ?? 0; // Jika bulan tiada dalam result, set ke 0
        }

        $out = [
            "jumlah_out" => $jumlah_out
        ];

        $wfh = DB::table('mra_wfh')
            ->selectRaw("MONTH(datesign) as month, COUNT(*) as total")
            ->whereYear('datesign', $Year_now)
            ->where('ic', $ic)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $jumlah_wfh = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlah_wfh[] = $wfh[$i] ?? 0;
        }

        $wfh_data = [
            "jumlah_wfh" => $jumlah_wfh
        ];

        $user = DB::table('mra_staff')->where('icno', $ic)->first();

        return view('dashboard', [
            'leaveLabels' => json_encode($leaveTypes),
            'leaveData' => json_encode($leaveCounts),
            'leaveno' => $leaveData,
            'claimdata' => json_encode($claim, JSON_UNESCAPED_UNICODE),
            'labelbulan' => json_encode($bulan, JSON_UNESCAPED_UNICODE),
            'claimno' =>$claim,
            'officedata' => json_encode($attan, JSON_UNESCAPED_UNICODE),
            'outdata' => json_encode($out, JSON_UNESCAPED_UNICODE),
            'wfhdata' => json_encode($wfh_data, JSON_UNESCAPED_UNICODE),
            'officeno' =>$attan,
            'outno' =>$out,
            'wfhno' =>$wfh_data,
            'user' => $user
        ]);
    }

}

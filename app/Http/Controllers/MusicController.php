<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class MusicController extends Controller
{
    public function listmusic() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        $music = DB::table('download')->where('ic', $ic)->get();
        return view('music', [
            'user' => $user,
            'musics' => $music
        ]);
    }

    public function downloadmusic() {
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();
        return view('downmusic', ['user' => $user]);
    }

    public function downloadMP3(Request $request) {
        $url = $request->url;
        $name = $request->name;
        $namesave = $request->savename;
        $date = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $ic = session('user_ic');
        $user = DB::table('mra_staff')->where('icno', $ic)->first();

        if (!$url || !$name) {
            return response()->json(['error' => 'URL dan Name diperlukan!'], 400);
        }

        try {
            // Pastikan direktori temp ada
            $tempDir = "C:/laragon/www/mraapp/storage/temp";
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // Pastikan direktori mp3 ada
            $outputDir = "C:/laragon/www/mraapp/storage/app/public/mp3";
            if (!file_exists($outputDir)) {
                mkdir($outputDir, 0777, true);
            }

            // Gunakan ID video dari URL sebagai nama file
            preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11})/', $url, $matches);
            $videoId = $matches[1] ?? uniqid(); // Jika tidak ditemukan, gunakan uniqid()

            // Simpan dalam database
            $id = DB::table('download')->insertGetId([
                'name' => $name,
                'ic' => $ic,
                'namesave' => $namesave,
                'url' => "$videoId.mp4",
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            if (!$id) {
                return response()->json(['error' => 'Gagal menyimpan ke database!'], 500);
            }

            // $command = 'C:\yt-dlp\yt-dlp.exe --extract-audio --audio-format mp3 --paths temp=C:\laragon\www\mraapp\storage\temp -o C:\laragon\www\mraapp\storage\app\public\mp3\%(id)s.%(ext)s https://youtu.be/bhXL4B00j3Q?si=1v8FsiD4G0JH1dmo';
                $command = 'C:\yt-dlp\yt-dlp.exe --extract-audio --audio-format mp3 '
                . '--paths temp=C:\laragon\www\mraapp\storage\temp '
                . '-o C:\laragon\www\mraapp\storage\app\public\mp3\%(id)s.%(ext)s '
                . '"' . $url . '" 2>&1';

            $output = shell_exec($command);

            if ($output) {
                $music = DB::table('download')->where('ic', $ic)->get();
                return view('music', [
                    'user' => $user,
                    'musics' => $music
                ]);
            } else {
                return response()->json(['message' => 'Download selesai!', 'output' => $output]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}

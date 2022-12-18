<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index() {
        $nilai = session('nilai');
        return view('index', [
            'nilai' => $nilai
        ]);
    }

    public function submitNilai(Request $request) {
        $nilai = new Nilai;
        $nilai->quiz = $request->quiz;
        $nilai->tugas = $request->tugas;
        $nilai->absensi = $request->absensi;
        $nilai->praktek = $request->praktek;
        $nilai->uas = $request->uas;

        $numGrade = ($nilai->quiz * 0.15) + ($nilai->tugas * 0.2) + ($nilai->absensi * 0.1) +
            ($nilai->praktek * 0.15) + ($nilai->uas * 0.3);
        if ($numGrade <= 65) {
            $nilai->grade = "D";
        } else if ($numGrade <= 75) {
            $nilai->grade = "C";
        } else if ($numGrade <= 85) {
            $nilai->grade = "B";
        } else {
            $nilai->grade = "A";
        }

        $request->session()->put('nilai', $nilai);
        return redirect('/');
    }
}

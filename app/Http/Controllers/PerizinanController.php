<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Absen;

class PerizinanController extends Controller
{
    public function index()
    {
        $perizinan = DB::table('absen')
        ->get(['id','izin_dari','izin_sampai', 'keterangan', 'approve']);

        return view('perizinan.index', compact('perizinan'));
    }

    public function create()
    {
        return view('perizinan.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $status = "proses";
        Absen::create([
            'izin_dari' => $request->izin_dari,
            'izin_sampai' => $request->izin_sampai,
            'keterangan' => $request->keterangan,
            'approve' => $status
        ]);
        return redirect('/perizinan');
    }

    public function edit($id)
    {
        $databsen = DB::table('absen')
        ->where('id','=',$id)
        ->get();

        return view('perizinan.edit', compact('databsen'));
    }

    public function update(Request $request, $id)
    {
        $databsen = DB::table('absen')
        ->where('id','=',$id)
        ->update([
            'approve' => $request['approve'],
        ]);
        return back();
    }

    public function destroy($id)
    {
        $databsen = DB::table('absen')
        ->where('id','=',$id)
        ->delete();

        return back();
    }

}

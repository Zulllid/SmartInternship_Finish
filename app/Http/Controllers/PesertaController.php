<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DataMagang;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

use App\Models\SettingMagang;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->input());
        // if ($request->has('search')) {
        //     $data = Siswa::where('tanggal_masuk', 'LIKE', '%' . $request->search . '%')->paginate(5);
        // } else {
        //     $data = Siswa::paginate(5);
        // }

        $data = DB::table('siswa')
            ->join('sekolah', 'sekolah.id', '=', 'siswa.sekolah_id')
            ->join('data_magang', 'data_magang.nisn', '=', 'siswa.nisn')
            ->join('pembimbing', 'pembimbing.nip_pembimbing', '=', 'siswa.nip_pembimbing')
            ->distinct();
        //
        $data = $data->get([
            'siswa.id',
            'nama_siswa',
            'sekolah.nama_sekolah',
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_project',
            'status_magang',
            'nama_pembimbing',
            'keterangan',
            'siswa.nisn AS nisn'
        ]);
        // $enkrip = Crypt::encrypt('8888');
        // echo $enkrip.'<br>';
        // echo Crypt::decrypt($enkrip);
        return view('peserta.index', compact('data'));
        // dd($data);
        // dd($data);
    }

    public function create()
    {
        $dtsklh = DB::table('sekolah')
            ->get();
        return view('peserta.create', compact('dtsklh'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'sekolah_id' => $request->sekolah_id,
            'nama_pembimbing' => $request->nama_pembimbing,
            'keterangan' => $request->keterangan,
        ]);

        DataMagang::create([
            'status_magang' => $request->status_magang,
            'judul_project' => $request->judul_project,
        ]);
        return redirect('/peserta');
    }

    public function edit($id)
    {
        $siswa = DB::table('siswa')
            ->join('sekolah', 'sekolah.id', '=', 'siswa.sekolah_id')
            ->join('data_magang', 'data_magang.nisn', '=', 'siswa.nisn')
            ->join('pembimbing', 'pembimbing.nip_pembimbing', '=', 'siswa.nip_pembimbing')
            ->where('siswa.id', '=', $id)
            ->get([
                'siswa.id',
                'siswa.nisn',
                'nama_sekolah',
                'nama_siswa',
                'tanggal_mulai',
                'tanggal_selesai',
                'nama_pembimbing',
                'status_magang',
                'keterangan',
                'judul_project',
                'sekolah.id as id_sekolah',
                'siswa.nip_pembimbing as nip'
            ]);

        $sekolah = DB::table('sekolah')
            ->get();

        $pembimbing = DB::table('pembimbing')
            ->get();

        return view('peserta.edit', compact('siswa', 'sekolah', 'pembimbing'));
    }

    public function show($id)
    {
        //ambil gambar dari tabel data_magang kolom Bukti pembayaran

        $siswa = DB::table('siswa')
        ->leftJoin('sekolah', 'sekolah.id', '=', 'siswa.sekolah_id')
        ->leftJoin('data_magang', 'data_magang.nisn', '=', 'siswa.nisn')
        ->leftJoin('pembimbing', 'pembimbing.nip_pembimbing', '=', 'siswa.nip_pembimbing')
        ->leftJoin('data_bidang', 'data_bidang.id', '=', 'data_magang.bidang_id')
        ->leftJoin('akuns', 'akuns.nisn', '=', 'siswa.nisn')
        ->where('siswa.id','=',$id)
        ->get([
            'siswa.id',
            'siswa.nisn',
            'nama_sekolah',
            'nama_siswa',
            'foto_siswa',
            'no_wa',
            'nama_bidang',
            'tanggal_mulai',
            'tanggal_selesai',
            'nama_pembimbing',
            'status_magang',
            'judul_project',
            'sekolah.id as id_sekolah',
            'siswa.nip_pembimbing as nip',
            'jurusan',
            'tanggal_lahir', 'no_wa_pembimbing', 'username', 'akuns.password AS password',
            'data_magang.bukti_pembayaran','surat_pengajuan'
        ]);


        // ambil url gambar
        $gambar = $siswa[0]->bukti_pembayaran;
        // dd($siswa->all());

        return view('peserta.show', compact('siswa', 'gambar'));
    }

    public function izin($id){
        $perizinan = DB::table('siswa')
        ->join('absen','absen.siswa_id','=','siswa.id')
        ->where('absen.siswa_id','=',$id)
        ->whereNotIn('absen.keterangan',[''])
        ->get([
            'izin_dari','izin_sampai','absen.keterangan AS keterangan','approve','absen.siswa_id AS id',
            'siswa.nama_siswa','absen.id AS absen_id'
        ]);

        return view('izin_admin.index', compact('perizinan'));

        // $perizinan = DB::table('absen')
        // ->where('siswa_id','=',auth()->user()->siswa->id)
        // ->get(['id','izin_dari','izin_sampai', 'keterangan', 'approve']);
        // // dd($perizinan);
        // return view('perizinan.index', compact('perizinan'));
    }

    // public function getData() {

    //     $fileName = time().'.'.$request->bukti->extension();
    //     $request->bukti->move(public_path('image'), $fileName);
    //     $bayar = new Bayar;

    //     DB::table('bayar')->insert([
    //         'bukti' => $fileName,
    //     ]);

    //     // $fileName = ['bukti'];
    //     return $fileName;
    // }

    public function update(Request $request/*, $id*/)
    {
        $message = [
            'tanggal_mulai.after_or_equal' => 'Tanggal tidak boleh diisi dengan tanggal sebelum hari ini.',
            'tanggal_selesai.after_or_equal' => 'Tanggal tidak boleh diisi dengan tanggal sebelum hari ini.',
        ];

        $request->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:today',
        ], $message);

        $updated = Siswa::find($request->id);
        $updated->nama_siswa = $request->nama_siswa;
        $updated->tanggal_mulai = $request->tanggal_mulai;
        $updated->tanggal_selesai = $request->tanggal_selesai;
        $updated->sekolah_id = $request->sekolah_id;
        $updated->nip_pembimbing = $request->nip_pembimbing;
        $updated->keterangan = $request->keterangan;
        $updated->save();
        $nisn_update = $request->nisn;

        $data_magang_up = DataMagang::where('nisn', $nisn_update)->firstOrFail();
        $data_magang_up->status_magang = $request->status_magang;
        $data_magang_up->judul_project = $request->judul_project;
        $data_magang_up->save();
        //26 Mei 2023
        // dd($updated->pembimbing->no_wa_pembimbing);
        // dd($updated->no_wa);
        // dd($updated->akun->username);
        //     //cek request status magangnya apa
        // $data_magang_up = DataMagang::where('nisn', $nisn_update)->firstOrFail();
        // $data_magang_up->judul_project = $request->judul_project;
        $settingmagang = SettingMagang::first();

        $status_magang = $request->status_magang;
        // dd($status_magang);
        if ($status_magang == "Belum Bayar" || $status_magang == "Seleksi") {



                    Mail::to($updated->akun->username)->send(new SendEmail([
                        'name' => 'PT Garuda Cyber Indonesia',
                        'body' => $settingmagang->Format_Email
                    ]));

                    // Ambil format WA dari SettingmagangController
                    // dd($settingmagang->Format_WA_Diterima);
                    // dd($settingmagang->Format_WA_Ditolak);
                    // dd($settingmagang->Format_Pembimbing);
                    // dd($settingmagang->Format_Email);
            $result = file_get_contents('https://testinguntuksendmessage.000webhostapp.com', false, stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'no_hp' => $updated->no_wa, # no hp penerima
                    // 'message' => 'test kirim wa' # pesan
                    'message' => $settingmagang->Format_WA_Diterima, // Menggunakan format WA dari SettingmagangController
                ])
            ]]));
        } elseif ($status_magang == 'tidak aktif'){
            // var_dump($updated->no_wa);
            // var_dump($settingmagang->Format_WA_Ditolak);
            $result = file_get_contents('https://testinguntuksendmessage.000webhostapp.com', false, stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'no_hp' => $updated->no_wa, # no hp penerima
                    // 'message' => 'test kirim wa' # pesan
                    'message' => $settingmagang->Format_WA_Ditolak, // Menggunakan format WA dari SettingmagangController
                ])
            ]]));
            // dd( $result);
        } elseif ($status_magang == 'Aktif'){
            $result = file_get_contents('https://testinguntuksendmessage.000webhostapp.com', false, stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'no_hp' => $updated->pembimbing->no_wa_pembimbing, # no hp penerima
                    // 'message' => 'test kirim wa' # pesan
                    'message' => $settingmagang->Format_Pembimbing, // Menggunakan format WA dari SettingmagangController
                ])
            ]]));
        }




            //bikin kondisi

            // pastekan dibawah ini
            // $nisn = $request->nisn;
            // $siswa = Siswa::where('nisn', $nisn)->first();

            // if ($siswa) {
            //     $no_wa = $siswa->no_wa;
            // } else {
            //     $no_wa = '085713482807'; // No HP default jika siswa tidak ditemukan
            // }
            //         // Ambil format WA dari SettingmagangController
            //         $settingmagangController = new SettingmagangController();
            //         $formatWA = $settingmagangController->getFormatWA();

            // $result = file_get_contents('https://testinguntuksendmessage.000webhostapp.com', false, stream_context_create(['http' => [
            //     'method'  => 'POST',
            //     'header'  => 'Content-Type: application/x-www-form-urlencoded',
            //     'content' => http_build_query([
            //         'no_hp' => $no_wa, # no hp penerima
            //         // 'message' => 'test kirim wa' # pesan
            //         'message' => $formatWA // Menggunakan format WA dari SettingmagangController
            //     ])
            // ]]));

                        //bikin condisi statusnya aktif baru nanti pesan wanya terkirim
                            // // buat untuk pmbimbing

                            // $nip_pembimbing = $request->nip_pembimbing;
                            // $pembimbing = pembimbing::where('nip_pembimbing', $nip_pembimbing)->first();

                            // if ($pembimbing) {
                            //     $no_wa_pembimbing = $pembimbing->no_wa_pembimbing;
                            // } else {
                            //     $no_wa_pembimbing = '085713482807'; // No HP default jika siswa tidak ditemukan
                            // }
                            //         // Ambil format WA dari SettingmagangController
                            //         $settingmagangController = new SettingmagangController();
                            //         $formatWA = $settingmagangController->getFormatWA();

                            // $result = file_get_contents('https://testinguntuksendmessage.000webhostapp.com', false, stream_context_create(['http' => [
                            //     'method'  => 'POST',
                            //     'header'  => 'Content-Type: application/x-www-form-urlencoded',
                            //     'content' => http_build_query([
                            //         'no_hp' => $no_wa_pembimbing, # no hp penerima
                            //         // 'message' => 'test kirim wa' # pesan
                            //         'message' => $formatWA // Menggunakan format WA dari SettingmagangController
                            //     ])
                            // ]]));

        return redirect('/peserta');
    }



    public function destroy($id)
    {
        $siswa = DB::table('siswa')
            ->where('nisn', '=', $id)
            ->delete();

        $siswa = DB::table('akuns')
        ->where('nisn', '=', $id)
        ->delete();

        return back();
    }
}

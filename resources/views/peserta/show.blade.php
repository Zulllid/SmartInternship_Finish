@extends('layout.master')

@section('content')
<div class="form-group row">
    <label for="inputNamaPeserta" class="col-sm-2 col-form-label">Nama Peserta</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNamaPeserta" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputNISN" class="col-sm-2 col-form-label">NISN</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNISN" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputNomorWA" class="col-sm-2 col-form-label">Nomor WA</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNomorWA" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputAsalSekolah" class="col-sm-2 col-form-label">Asal Sekolah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputAsalSekolah" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputJurusan" class="col-sm-2 col-form-label">Jurusan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputJurusan" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputTanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="inputTanggalLahir" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputNIPPembimbing" class="col-sm-2 col-form-label">NIP Pembimbing</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNIPPembimbing" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputNamaPembimbing" class="col-sm-2 col-form-label">Nama Pembimbing</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNamaPembimbing" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputNomorPembimbing" class="col-sm-2 col-form-label">Nomor Pembimbing</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNomorPembimbing" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputFotoPeserta" class="col-sm-2 col-form-label">Foto Peserta</label>
    <div class="col-sm-10">
      {{-- <input type="button" class="form-control" id="inputFotoPeserta" placeholder=""> --}}
      <input type="button" value="Download.jpg">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputSuratPengajuan" class="col-sm-2 col-form-label">Surat Pengajuan</label>
    <div class="col-sm-10">
      {{-- <input type="text" class="form-control" id="inputNamaPeserta" placeholder=""> --}}
      <input type="button" value="Download.pdf">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputAlamatEmail" class="col-sm-2 col-form-label">Alamat Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputAlamatEmail" placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" placeholder="">
      <input type="button" value="Ganti Password">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputLogbook" class="col-sm-2 col-form-label">Logbook</label>
    <div class="col-sm-10">
      <input type="button" value="Lihat">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPerizinan" class="col-sm-2 col-form-label">Perizinan</label>
    <div class="col-sm-10">
      <input type="button" value="Lihat">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputAbsensi" class="col-sm-2 col-form-label">Absensi</label>
    <div class="col-sm-10">
      <input type="button" value="Lihat">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputReportSertifikat" class="col-sm-2 col-form-label">Report dan Sertifikat</label>
    <div class="col-sm-10">
      <input type="button" value="Lihat">
    </div>
  </div>
@endsection

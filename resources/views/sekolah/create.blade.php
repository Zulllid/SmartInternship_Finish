@extends('layout.master')

@section('content')

<div class="card shadow mb-4">
        <div class="card-header ">
            <div class="row">
                <div class="col-3">
                    <h6 class="mb-3 font-weight-bold text-primary">Tambah Sekolah</h6>
                    <form method="POST" action="{{ route('sekolah.store') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="inputnis" style="">NIS</label>
                          <input type="text" class="form-control" name="nis" placeholder="Masukkan Nis" style="margin-left: 200px;margin-top: -35px;width: 900px">
                        </div>
                        <div class="form-group">
                          <label for="inputNamaSekolah" style="">Nama Sekolah</label>
                          <input type="text" class="form-control" name="nama_sekolah" placeholder="Masukkan Nama Sekolah" style="margin-left: 200px;margin-top: -35px;width: 900px">
                        </div>
                        <div class="form-group">
                          <label for="inputAlamatSekolah" style="">Alamat Sekolah</label>
                          <input type="text" class="form-control" name="alamat_sekolah" placeholder="Masukkan Alamat Sekolah" style="margin-left: 200px;margin-top: -35px;width: 900px">
                        </div>
                        <input type="text" hidden name="">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
@endsection

@extends('layout.master')

@section('content')

<button type="submit" style="color: white;background-color: rgb(46, 165, 74);border-radius: 10px;margin-left: 1100px">Tambah Data</button>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Dari</th>
        <th scope="col">Sampai</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Approve</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
  </table>
@endsection

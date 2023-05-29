@extends('layout.master')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header ">
        <div class="row">
            <div class="col-3">
                <h6 class="m-0 font-weight-bold text-primary">Pembimbing</h6>
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#pembimbing-table').DataTable();
                    });

                    function confirmDelete(url) {
                        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                            window.location.href = url;
                        }
                    }
                </script>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nip Pembimbing</th>
                      <th scope="col">Nama Pembimbing</th>
                      <th scope="col">No Wa Pembimbing</th>
                      <th scope="col">Asal Sekolah</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($pembimbing as $item)
                    <tr>
                        <td>{{$no++ }}</td>
                        <td>{{$item->nip_pembimbing}}</td>
                        <td>{{$item->nama_pembimbing}}</td>
                        <td>{{$item->no_wa_pembimbing}}</td>
                        <td>{{$item->nama_sekolah}}</td>
                        <td> <a href="{{ route('pembimbing.edit', $item->id) }}" class="btn btn-success">
                            <i class='bx bxs-pencil' ></i> Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDelete('{{ route('pembimbing.hapus', $item->id) }}')" class="btn btn-danger"><i class='bx bxs-trash' style="width: 15px;height: 20px;"></i> Hapus</a>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {!! $perizinan->links() !!} --}}
        </div>
    </div>
</div>
  </table>
@endsection

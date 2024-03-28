@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Perpustakaan</div>
                    <div class="breadcrumb-item">Peminjaman Buku</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Peminjaman Buku</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Buku</th>
                                                <th>Tanggal Dipinjam</th>
                                                <th>Tanggal Dikembalikan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($peminjaman as $peminjaman)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $peminjaman->buku->judul }}</td>
                                                <td>{{ $peminjaman->{'tanggal_pinjam'} }} </td>
                                                <td>{{ $peminjaman->tanggal_kembali }}</td>
                                                <td>{{ $peminjaman->status }}</td>
                                               <td> 
                                                @if($peminjaman->status == 'Dipinjam')
                                                <form action="{{ route('peminjaman.update', ['peminjaman' => $peminjaman->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="Dikembalikan">
                                                    <input type="hidden" name="tanggal_kembali" value="{{ date('Y-m-d') }}">
                                                    <button type="submit" class="btn btn-lg btn-primary">
                                                        Kembalikan
                                                    </button>
                                                </form>
                                                @elseif($peminjaman->status == 'dikembalikan')
                                                <span>Sudah Dikembalikan</span>
                                                 @endif
                                               </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
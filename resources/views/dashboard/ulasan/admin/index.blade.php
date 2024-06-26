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
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Perpustakaan</div>
                    <div class="breadcrumb-item">{{ $title }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Ulasan</th>
                                                <th>Rating</th>
                                                <th>Dari</th>
                                                <th>Untuk buku</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ulasan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if (strlen($item->ulasan) > 50)
                                                            {{ substr($item->ulasan, 0, 50).'...' }}
                                                        @else
                                                            {{ $item->ulasan }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->rating }}</td>
                                                    <td>
                                                        <a href="{{ route('user.show', $item->user->slug) }}">
                                                            {{ '@'.$item->user->username }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('buku.show', $item->buku->slug) }}">
                                                            {{ $item->buku->judul }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->created_at->format('j-n-Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('ulasan.show', $item->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Lihat Ulasan">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('ulasan.destroy', $item->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true" data-toggle="tooltip" title="Hapus Ulasan">
                                                            <i class="fas fa-trash" onclick="event.preventDefault(); this.closest('a').click();"></i>
                                                        </a>
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

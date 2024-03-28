@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
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
                    <div class="breadcrumb-item">
                        <a href="{{ route('pustaka.index') }}">Pustaka Buku</a>
                    </div>
                    <div class="breadcrumb-item">Detail Buku</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Buku</h4>
                            </div>
                            <div class="card-body">
                                <div class="tickets">
                                    <div class="ticket-items" id="ticket-items">
                                        <div class="gallery mt-2">
                                            <div class="gallery-item" data-image="{{ asset($buku->gambar) }}" data-title="{{ $buku->judul }}"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="ticket-content">
                                        <div class="ticket-header">
                                            <div class="ticket-detail">
                                                <div class="ticket-title">
                                                    <h4>{{ $buku->judul }}</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div class="font-weight-600">{{ $buku->penulis }}</div>
                                                    <div class="bullet"></div>
                                                    <div class="font-weight-600">{{ $buku->penerbit }}</div>
                                                    <div class="bullet"></div>
                                                    <div class="font-weight-600">{{ $buku->tahun_terbit }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="ticket-description">
                                            {{ $buku->deskripsi }}
                                            <div class="ticket-divider"></div>
                                            <div class="ticket-form">
                                                <div class="{{ $koleksi ? 'd-none' : '' }}">
                                                    <form action="{{ route('koleksi.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                                        {{-- <input type="hidden" name="tanggal_pinjam" value="{{ now()->toDateString() }}"> --}}
                                                        <button type="submit" class="btn btn-lg btn-primary">
                                                            <i class="fas fa-bookmark"></i>
                                                            Tambah Buku Ke koleksi
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="{{ $peminjaman ? 'd-none' : '' }}">
                                                    <form action="{{ route('peminjaman.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                                        <input type="hidden" name="tanggal_pinjam" value="{{ now()->toDateString() }}">
                                                        <input type="hidden" name="tanggal_kembali" value="-">
                                                        <input type="hidden" name="status" value="Dipinjam">
                                                        <button type="submit" class="btn btn-lg btn-primary">
                                                            <i class="fas fa-bookmark"></i>
                                                            Pinjam Buku
                                                        </button>
                                                    </form>
                                                </div>
                                                
                                                <div class="{{ $ulasan ? 'd-none' : '' }}">
                                                    <button type="button" class="btn btn-primary float-center" data-toggle="modal" data-target="#modalReview">                                                            <i class="fas fa-star"></i>
                                                    Tambah Review</button>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="card-title mt-5">Ulasan Buku</h6>
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                @foreach ($buku->ulasan as $item)
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <h6 class="card-subtitle mb-2 text-muted">{{ $item->user->name }}</h6>
                                                            <p class="card-text">Rating: {{ $item->rating }} <i class="fas fa-star"></i></p>
                                                            <p class="card-text">{{ $item->ulasan }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
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
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endsection

<!-- Modal -->
<div class="modal fade" id="modalReview" tabindex="-1" aria-labelledby="modalReviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReviewLabel">Tambah Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM TAMBAH BARANG-->
                <form action="{{ route('ulasan.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="section-title">Tulis Ulasan dan Rating Kamu</div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <div class="selectgroup selectgroup-pills">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="selectgroup-item">
                                    <input type="radio" name="rating" value="{{ $i }}" class="selectgroup-input" required>
                                    <span class="selectgroup-button selectgroup-button-icon">
                                        {{ $i }}
                                        <i class="fas fa-star"></i>
                                    </span>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                   <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                    <div class="form-group">
                        <label for="ulasan">Ulasan</label>
                        <textarea class="form-control" name="ulasan" id="ulasan" style="height: 150px" placeholder="Tulis ulasan kamu..." required>{{ old('ulasan') }}</textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary btn-lg">Upload</button>
                    </div>
                </form>
                <!--END FORM TAMBAH BARANG-->
            </div>
        </div>
    </div>
</div>

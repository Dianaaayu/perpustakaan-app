@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Daftar buku</h1>
            <form action="{{ route('buku.public.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari Buku / Penulis....."
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach ($buku as $book)
        <div class="col-md-4 mb-4">
            <div class="card">
            @if(Storage::disk('local')->exists('public/buku/'.$book ->cover))
                               <img src="{{ storage::url('public/buku/'). $book->cover }}" class="img-fluid img-thumbnail">
                               @else
                               <img src="{{ storage::url('public/buku/default.jpg') }}" class="img-fluid img-thumbnail">
                               @endif
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $book->judul }}</h5>
                    <p class="card-text">{{ $book->penulis }}</p>
                </div>
                <a href="{{ route('buku.public.show', $book->id) }}" class="btn btn-primary">Detail Buku</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
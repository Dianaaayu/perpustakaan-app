@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Detail Buku</h1>
    <div class="row">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ Storage::url($buku->cover) }}" alt="{{ $buku->judul }}" class="card-img-top"
                        style="max-width: 55%; width: auto;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Judul : </strong>{{ $buku->judul }}</h5>
                        <p class="card-text"><strong>Penulis : </strong>{{ $buku->penulis }}</p>
                        <p class="card-text"><strong>Tahun_terbit : </strong>{{ $buku->tahun_terbit }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
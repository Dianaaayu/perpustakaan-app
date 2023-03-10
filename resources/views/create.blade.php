@extends('layouts.app')

@section('content')
     <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card border-0 shadow rounded">
              <div class="card-header">
                  <h4 class="text-center">
                   <i class="bi bi-book"></i> Tambah Buku 
               </h4>
           </div>
           <div class="card-body">
                <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                  @csrf 
                  @method('POST')
                  <div class="form-group">
                    <label for="judul" class="fw-bold">Judul</label>
                    <input type="text" class="form-control" placeholder="Judul" value="{{ old('judul') }}" name="judul">
                    @error('judul')
                          <span class="text-danger">{{ $message }}</span>
                    @enderror
             </div>
             <div class="form-group">
                    <label for="judul" class="fw-bold">Penulis</label>
                    <input type="text" class="form-control" placeholder="penulis" value="{{ old('penulis') }}" name="penulis">
                    @error('penulis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
             </div>
             <div class="form-group">
                    <label for="tahun" class="fw-bold">Tahun Terbit</label>
                    <input type="number" class="form-control" placeholder="Tahun Terbit" value="{{ old('tahun_terbit') }}" name="tahun_terbit">
                    @error('tahun_terbit')
                        <spafn class="text-danger">{{ $message }}</span>
                    @enderror
             </div>
           
            <div class="form-group">
              <label for="cover" class="fw-bold">Cover</label>
              <input type="file" name="cover" class="form-control">
              @error('cover')
                 <span class="text-danger">{{ $message}}</span>
                 @enderror
            </div> 
            <div class="form-group d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-sd-card"></i>Simpan</button>
              <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary mx-2">Batal</a>
              
           </form>
         </div>
        </div>
      </div>
    </div>
  </div>
@endsection
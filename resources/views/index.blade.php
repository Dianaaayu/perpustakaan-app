@extends('layouts.app')

@section('content')
     <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card border-0 shadow rounded">
              <div class="card-header">
                  <h4 class="text-center">
                   <i class="bi bi-book"></i> Daftar Buku 
               </h4>
           </div>
           <div class="card-body">
           <a href="{{ route('buku.create') }}" class="btn btn-primary"><i class="bi bi-plus-square-dotted"></i> Tambah Buku </a>
            <table class="table table-bordered table-striped mt-2">
              <thead class="text-center">
                <th style="width:50px">No</th>
                <th style="width:200px">Cover</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Tahun Terbit</th>
                  <th style="width:200px"></th>
              </thead>
              <tbody>
                  @forelse($bukus as $i => $buku)  
                        <tr>
                          <td class="text-center">{{ $i + 1 }}</td>
                          <td class="text-center">
                            @if(Storage::disk('local')->exists('public/buku/'.$buku ->cover))
                               <img src="{{ storage::url('public/buku/'). $buku->cover }}" class="img-fluid img-thumbnail">
                               @else
                               <img src="{{ storage::url('public/buku/default.jpg') }}" class="img-fluid img-thumbnail">
                               @endif
                          </td> 
                          <td>{{ $buku->judul }}</td>
                          <td>{{ $buku->penulis }}</td>
                          <td>{{ $buku->tahun_terbit}}</td>
                          <td class="text-center"> 
                              <a href="{{route('buku.edit', $buku->id)   }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i> Edit</a>
                              <form action="{{ route('buku.destroy', $buku->id) }}" method="POST"
                              style="display: inline-block;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </tr>
                  @empty
                      <tr>
                        <td colspan="6">
                    <div class="alert alert-info">Data buku tidak tersedia</div>
                  </td>
               </tr>
              @endforelse
              </tbody>
            </table>
            {{ $bukus->links() }}
         </div>
        </div>
      </div>
    </div>
  </div>
  
  {{-- MODAL --}}
  <div class="modal fade" id="hapusBukuModal" tabindex="-1" aria-hidden="true" aria-labelledby="hapusBukuModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusBukuModalLabel">Hapus Buku</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus buku ini?
      </div>
      <div class="modal-footer">
        <form action="" method="post">
          @csrf 
          @method('DELETE')
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
        </form>
</div>
@endsection
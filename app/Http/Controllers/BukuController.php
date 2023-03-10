<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function indexPublic(Request $request)
     {
         //Menampilkan Semua Data Di user
         $buku = Buku::all();
 
         //Mencari Data Di user
         if ($request->has('search')) {
             $search = $request->search;
             $buku = Buku::where('judul', 'LIKE', '%' . $search . '%')
                         ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                         ->orWhere('tahun_terbit', 'LIKE', '%' . $search . '%')
                         ->get();
         }
 
         return view('buku.public.index', compact('buku'));
     }
     
     public function showPublic($id)
     {   
         //Menampilkan Data Detail Buku Berdasarkan Buku yang Dipilih Di Halaman User
         return view('buku.public.show', ['buku' => Buku::findOrFail($id)]);
     }
    public function index()
    {
        $bukus = Buku::latest()->paginate(10);
        return view('index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'cover' => 'required|image|mimes:png,jpg,jpeg',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $cover = $request->file('cover');
        $cover->storeAs('public/buku', $cover->hashName());

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->cover = $cover->hashName();
        $buku->save();

        if($buku) {
            return redirect()->route('buku.index')->with(['sukses' => 'Buku berhasil disimpan']);
        } else {
            return redirect() ->route('buku.index')->with(['gagal' => 'Buku gagal disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return redirect()->route('buku.index')->with(['gagal' => "Buku tidak ditemukan!"]);
        }
        return view('edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $buku = Buku::find($id);
        if (!$buku) {
            return redirect()->route('buku.index')->with(['gagal' => "Buku tidak ditemukan!"]);
        }

        if ($request->file('cover') == ''){
            $buku->judul = $request->judul;
            $buku->penulis = $request->penulis;
            $buku->tahun_terbit = $request->tahun_terbit;
            $buku->update();
        } else {
            Storage::disk('local')->delete('public/buku/'.$buku->cover);

            $cover = $request->file('cover');
            $cover->storeAs('public/buku', $cover->hashName());

                $buku->judul = $request->judul;
                $buku->penulis = $request->penulis;
                $buku->tahun_terbit = $request->tahun_terbit;
                $buku->cover = $cover->hashName();
                $buku->update();
        }

        if($buku) {
            return redirect()->route('buku.index')->with(['sukses' => 'Buku berhasil diperbarui']);
        } else {
            return redirect() ->route('buku.index')->with(['gagal' => 'Buku gagal diperbarui']);
        }
        
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     $buku = Buku::findOrFail($id);
    //     $buku->delete();

    //     return redirect()->route('buku.index');
    //     // return view('index');
        
    //     // if (!$buku) {
    //     //     return redirect()->route('buku.index')->with(['gagal' => "Buku tidak ditemukan!"]);
    //     //     $buku->delete();
    //     //     if($buku) {
    //     //         return redirect()->route('buku.index')->with(['sukses' => 'Buku berhasil dihapus']);
    //     //     } else {
    //     //         return redirect() ->route('buku.index')->with(['gagal' => 'Buku gagal dihapus']);
    //     //     }
    //     // }
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        // hapus file buku dari penyimpanan
        if ($buku->image) {
            Storage::delete('public/'.$buku->image);
        }

        // hapus data buku
        $buku->delete();

        // Redirect ke halaman index user dengan alert succes
        return redirect()->route('buku.index')->with('success', 'Buku Berhasil Dihapus');
    }   
}

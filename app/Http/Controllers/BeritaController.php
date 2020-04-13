<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Berita;
use App\Kategori;

class BeritaController extends Controller
{

    
    public function view()
    {
        $kategori = Kategori::all();
        $data = DB::table('beritas')
            ->join('kategoris', 'beritas.kategori_id', '=', 'kategoris.kategori_id')
            ->select('beritas.*', 'kategoris.kategori_nama')
            ->get();
            // ->where('berita_id', 1)
            // ->groupBy('tanggal_post');
        // return view('backend/berita/view',compact('data'));
        return view('backend/berita/view',['data'=>$data, 'kategori'=>$kategori]);
    }


    
    public function store(Request $request)
    {
        $tbl = new Berita;
        $slug = Str::slug($request->judul, '-');
        $request->validate([
            'berita_images' => 'required|mimes:pdf,png,jpg,jpeg,xlx,csv|max:2048',
            'judul'  => 'required'
        ]);
        $fileName = time().'.'.$request->berita_images->extension(); 
        $request->berita_images->move(public_path('uploads/berita'), $fileName);

        $tbl->kategori_id = $request->id_kategori;
        $tbl->berita_judul = $request->judul;
        $tbl->berita_images = $fileName;
        $tbl->berita_slug = $slug;
        $tbl->tanggal_post = $request->tanggal;
        $tbl->berita_deskripsi = $request->deskripsi;

        $tbl->save();

        return back()->with('success','Data berita berhasil ditambah');

    }

    public function edit($id)
    {
         //$data = DB::table('beritas')->where('berita_id', '=', 100)->get();
    }

  
    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        // $data = DB::table('beritas')->where('berita_id', $id)->delete();
        $data = Berita::find($id)->delete();
        return back();
    }
}

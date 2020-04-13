<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kategori;

class KategoriController extends Controller
{
    public function view(){

        // $data = Kategori::all();
        // return view('backend/kategori/view', compact('data'));
        $data = DB::table('kategoris')->get();
        return view('backend/kategori/view',['data' => $data]);
    }

    public function store(Request $req){
        // $tbl = new Kategori;
        // $tbl->linimasa_judul = $request->judul;
        // $tbl->save(); 
       
        DB::table('kategoris')->insert(
            ['kategori_nama' => $req->kategori]
        );
        return back()->with('success','Kategori Berhasil Ditambah');
    }

    public function edit($id){

      
        // $data = Kategori::find($id);
        $data = DB::table('kategoris')->where('kategori_id', $id)->get();
        return response()->json($data);
        

        
    }

    public function update(Request $req ){

        // $tbl = Kategori::find($request->id);
        // $tbl->linimasa_judul = $request->judul;
        // $tbl->update(); 

        $data = DB::table('kategoris')
                ->where('kategori_id', $req->id)
                ->update(['kategori_nama' => $req->kategori]);
                
        return back()->with('success','Data kategori berhasil Di update');
        
    }
  

    public function destroy($id)
    {
      
        // $data = Linimasa::find($id)->delete();
        $data = DB::table('kategoris')
                ->where('kategori_id', $id)
                ->delete();
        return back();
    }


    
}
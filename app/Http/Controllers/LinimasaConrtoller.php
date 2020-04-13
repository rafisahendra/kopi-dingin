<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Linimasa;

class LinimasaConrtoller extends Controller
{
 
    public function index()
    {
        $data = Linimasa::all();
        return view('backend/linimasa/view', compact('data'));
      
    }

    public function store(Request $request)
    {
    
        $tbl = new Linimasa;
        $request->validate([
            'gambar' => 'required|mimes:pdf,png,jpg,jpeg,xlx,csv|max:2048',
            'judul'  => 'required'
        ]);
        $fileName = time().'.'.$request->gambar->extension(); 
        $tbl->linimasa_judul = $request->judul;
        $tbl->linimasa_gambar = $fileName;
        $tbl->save(); 
        $request->gambar->move(public_path('uploads/linimasa'), $fileName);

        return back()->with('success','You have successfully upload file.')->with('gambar',$fileName);
    }

    public function edit($id)
    {
        $data = Linimasa::find($id);
        return response()->json($data);
        
    }

    // public function update(Request $request, $id) Jika method put membawa parameter ID
    public function update(Request $request) //Jika parameter Id Di dalam FORM 
    {  
        $tbl = Linimasa::find($request->id);
        if($request->gambar == TRUE){
           
            $request->validate([
                'gambar' => 'required|mimes:pdf,png,jpg,jpeg,xlx,csv|max:2048',
                'judul'  => 'required'
            ]);
            $fileName = time().'.'.$request->gambar->extension(); 
            $tbl->linimasa_gambar = $fileName;
            $request->gambar->move(public_path('uploads/linimasa'), $fileName);
           
            $image_path = public_path().'/uploads/linimasa/'.$request->gambar_lama;
            if(file_exists($image_path)){
                // var_dump($image_path);exit;
                // unlink($image_path);
                File::delete($image_path);
            }

        }else{
            $tbl->linimasa_gambar = $request->gambar_lama;
        }
            $tbl->linimasa_judul = $request->judul;
            $tbl->update(); 
            
            return redirect('/linimasa/data')->with('success','You have successfully Update.');
        
    }

    public function destroy($id, $gambar)
    {
        $image_path = public_path().'/uploads/linimasa/'.$gambar;
        if(file_exists($image_path)){
            // var_dump($image_path);exit;
            File::delete($image_path);
        }
        $data = Linimasa::find($id)->delete();
        return back();
    }

  
}

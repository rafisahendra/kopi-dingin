@extends('backend/template')
@section('content')
<div class="card">
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 mt-3">
            <form action="/linimasa/edit/{{ $data->linimasa_id }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                @method('put')
                <div class="form-group">
                <input type="text" class="form-control" value="{{$data->linimasa_judul}}" name="judul">
                </div>
                <div class="form-group">
                <input type="hidden" class="form-control" value="{{$data->linimasa_gambar}}" name="gambar_lama">
                    <input type="file" class="form-control" value="" name="gambar">
                </div>
                <div class="form-group">
                <button type='submit' class="btn btn-danger">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endsection
@extends('backend/template')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card  card-outline callout callout-info">
                <div class="card-header">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    {{-- <div class="alert alert-default alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <img src="{{asset('uploads/'.Session::get('gambar')) }}" width="100px">
                </div> --}}
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Data Galerry</h3>
                    </div>
                    <div class="col-md-6 ">
                        <button type="button" class="btn btn-primary btn-flat btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModal">
                            <span class="fas fa-pencil-alt"></span> New Entry
                        </button>
                    </div>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50px">XX</th>
                            <th width="10px"><span class="fas fa-check"></span></th>
                            <th width="10px">No</th>
                            <th width="100px">Gambar</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach($data as $d)
                        <tr>
                            <td>
                                <form action="/linimasa/delete/{{$d->linimasa_id}}/{{$d->linimasa_gambar}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button style="width:25px" class="btn btn-default btn-flat btn-sm pr-3"><span
                                            class="fa fa-trash"></span></button>
                                    <button style="width:25px" type="button" onclick="editLinimasa({{$d->linimasa_id}})"
                                        class="btn btn-default btn-flat btn-sm pr-3"><span
                                            class="fa fa-edit"></span></button>
                                </form>
                                {{-- <a  style="width:25px" href="/linimasa/edit/{{$d->linimasa_id}}" class="btn
                                btn-default btn-flat btn-sm pr-3"><span class="fa fa-edit"></span></a> --}}
                            </td>
                            <td><input type="checkbox"> </td>
                            <td>{{$no++ }}</td>
                            <td><img src="{{asset('uploads/linimasa/'.$d->linimasa_gambar)}}" width="100px" alt=""></td>
                            <td>{{$d->linimasa_judul}}</td>

                        </tr>
                        @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    </div>
    <!-- /.row -->
</section>

<!-- Modal Tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Entry</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/linimasa/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for="">Title</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="">Images</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button style="width:75px" type="reset" class="btn btn-secondary btn-flat btn-sm">Reset</button>
                    <button style="width:75px" type="submit" class="btn btn-primary btn-flat btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <div class="modal-body">
            <form action="/linimasa/edit/" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="hidden" class="form-control"  name="id">
                    <input type="hidden" class="form-control" name="gambar_lama">
                    <input type="text" class="form-control"  name="judul">
                </div>
                <div class="form-group">
                    <label for="">Images</label>
                    <input type="file" class="form-control" value="" name="gambar">
                </div>
                <div class="modal-footer">
                    <button style="width:75px" type="reset" class="btn btn-secondary btn-flat btn-sm">reset</button>
                    <button style="width:75px" type="submit" class="btn btn-danger btn-flat btn-sm">Update</button>
                </div>
            </form>
           </div>
        </div>
    </div>
</div>


<script>
    function editLinimasa(linimasa_id) {
        $.ajax({
            url: '/linimasa/edit/' + linimasa_id,
            type: 'GET',
            success: function (data) {
                // console.log(data)
                $("[name=id]").val(data.linimasa_id);
                $("[name=judul]").val(data.linimasa_judul);
                $("[name=gambar_lama]").val(data.linimasa_gambar);
                $('#modalEdit').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

</script>
@endsection

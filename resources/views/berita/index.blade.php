@extends('layouts.adminmain')

@section('content')

<!-- Important to work AJAX CSRF -->
<meta name="_token" content="{!! csrf_token() !!}" />

<section class="section">
  
  <div class="section-header">
    <h1>Berita</h1>
  </div>

  @if ($message = Session::get('success'))
      <div class="card">
          <div class="card-body">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
          </div>
      </div>
  @endif
  
  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <form method="GET" class="form-inline">
            <div class="form-group">
              <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->get('search') }}">
            </div>
            &nbsp;
            <div class="form-group">
              <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
            </div>
          </form>
          &nbsp;
          <a href="{{ route('berita.index') }}" class="pull-right btn btn-outline-info">All Data</a>
        </div>
        <div class="card-header">
          <button id="btn_add" name="btn_add" type="button" data-toggle="modal" data-target="#addData" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Tambah Berita
          </button>
          &nbsp;
          <a class="btn btn-success" href="{{-- route('berita.export') --}}"><i class="fa fa-print"></i> Export Data</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Link</th>
                  <th scope="col"><center>Gambar</center></th>
                  <th scope="col"><center>Action</center></th>
                </tr>
              </thead>
              <tbody id="jurusans-list" name="jurusans-list">
                @forelse($data as $berita)
                <tr>
                  <td align="center">{{ ++$i }}</td>
                  <td>{{ $berita->berita_judul }}</td>
                  <td>{{ $berita->berita_link }}</td>
                  <td align="center"><img width="120px" src="{{ url('/images/berita/'.$berita->berita_gambar) }}"></td>
                  <td align="center">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-warning view_modal color" data-toggle="modal" data-target="#editData{{$berita->berita_id}}"><i class="fas fa-pen"></i></button>
                      <a style="background-color: #c0c0c0; border-color: #c0c0c0;" class="btn btn-sm btn-secondary color open_modal" href="{{ route('berita.show', $berita->berita_id) }}"><i class="fas fa-list"></i></i></a>
                      <button class="btn btn-sm btn-danger view_modal color" data-toggle="modal" data-target="#deleteData{{$berita->berita_id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </div>   
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3"><center>Data kosong</center></td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right">
          <nav class="d-inline-block">
            {!! $data->appends(request()->except('page'))->render() !!}
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal ADD -->
  <div class="modal fade" id="addData" role="dialog" aria-labelledby="addData" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"> 
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="DataLabel"><i class="far fa-plus-square"></i>&nbsp; Tambah Data berita</h5>
          </div>
          <hr>
          <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputJudulBerita" style="font-weight: bold;">
                Judul Berita<i style="color: red;">*</i>
              </label>
              <input name="berita_judul" type="text" class="form-control" id="inputNamaJurusan" placeholder="Masukkan Judul Berita" required="" style="font-weight: bold;">
            </div>
            <div class="form-group">
              <label for="inputLinkBerita" style="font-weight: bold;">
                Link Berita<i style="color: red;">*</i>
              </label>
              <input name="berita_link" type="text" class="form-control" id="inputNamaJurusan" placeholder="Masukkan Link Berita" required="" style="font-weight: bold;">
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="berita_gambar" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambahkan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- End of Modal Add -->

<!-- Modal Edit -->
  @foreach($data as $berita)
    <div class="modal fade" id="editData{{$berita->berita_id}}" role="dialog" aria-labelledby="deleteData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{ route('berita.update', $berita->berita_id) }}" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="far fa-edit"></i> &nbsp; Edit Data Berita</h5>
            </div>
            <hr>
            <div class="modal-body">
              @csrf 
              @method('PATCH')
              <div class="form-group">
                <label style="font-weight: bold;">Judul Berita<i style="color: red;">*</i></label>
                <input type="text" name="berita_judul" class="form-control" value="{{ $berita->berita_judul }}" required="" style="font-weight: bold;">
              </div>
              <div class="form-group">
                <label style="font-weight: bold;">Link Berita<i style="color: red;">*</i></label>
                <input type="text" name="berita_link" class="form-control" value="{{ $berita->berita_link }}" required="" style="font-weight: bold;">
              </div>
              <div class="form-group">
                <label for="harga" class="control-label">Gambar</label>
                <input name="berita_gambar" type="file" class="form-control" value="{{ url('/images/berita/'.$berita->berita_gambar) }}">
                <input name="hidden_image" type="hidden" class="form-control" value="{{$berita->berita_gambar}}">
              </div>

              <div class="form-group">
                  <img src="{{ url('/images/berita/'.$berita->berita_gambar) }}" width="150px">
              </div> 

            </div>
            <div class="modal-footer">
              <button style="background-color: #c0c0c0; border-color: #c0c0c0;" type="button" class="btn btn-secondary" data-dismiss="modal">
                Batal
              </button>
              <button type="submit" class="btn btn-warning">
                <b>Save</b>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach
<!-- End of Modal Edit-->

<!-- Modal DELETE -->
  @foreach($data as $berita)
    <div class="modal fade" id="deleteData{{$berita->berita_id}}" role="dialog" aria-labelledby="deleteData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{route('berita.destroy', $berita->berita_id)}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp; Konfirmasi Hapus</h5>
            </div>
            <hr>
            <div class="modal-body">
              <div class="form-group">
                <h5>
                  <br>
                    Yakin Ingin Menghapus <b>{{$berita->berita_judul}}</b> ? 
                </h5>
              </div>
            </div>
            <div class="modal-footer">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach
<!-- End of Modal DELETE--> 

@endsection()
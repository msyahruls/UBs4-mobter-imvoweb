@extends('layouts.adminmain')

@section('content')

<!-- Important to work AJAX CSRF -->
<meta name="_token" content="{!! csrf_token() !!}" />

<section class="section">
  
  <div class="section-header">
    <h1>Jurusan</h1>
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
          <a href="{{ route('jurusan.index') }}" class="pull-right btn btn-outline-info">All Data</a>
        </div>
        <div class="card-header">
          <button id="btn_add" name="btn_add" type="button" data-toggle="modal" data-target="#addData" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Tambah Jurusan
          </button>
          &nbsp;
          <a class="btn btn-success" href="export_jurusan"><i class="fa fa-print"></i> Export Data</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col"><center>Jumlah Perusahaan</center></th>
                  <th scope="col"><center>Action</center></th>
                </tr>
              </thead>
              <tbody id="jurusans-list" name="jurusans-list">
                @forelse($data as $jurusan)
                <tr>
                  <td width="5%" align="center">{{ ++$i }}</td>
                  <td>{{ $jurusan->jurusan_nama }}</td>
                  <td width="20%" align="center">{{ $jurusan->perusahaan->count() }}</td>
                  <td width="15%" align="center">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-warning view_modal color" data-toggle="modal" data-target="#editData{{$jurusan->jurusan_id}}"><i class="fas fa-pen"></i></button>
                      <a class="btn btn-sm btn-secondary color open_modal" style="background-color: #c0c0c0; border-color: #c0c0c0;" href="{{ route('jurusan.show', $jurusan->jurusan_id) }}">
                        <i class="fas fa-list"></i>
                      </a>
                      <button class="btn btn-sm btn-danger view_modal color" data-toggle="modal" data-target="#deleteData{{$jurusan->jurusan_id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </div>   
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4"><center>Data kosong</center></td>
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
        <form action="{{ route('jurusan.store') }}" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="DataLabel"><i class="far fa-plus-square"></i>&nbsp; Tambah Data Jurusan</h5>
          </div>
          <hr>
          <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputNamaJurusan" style="font-weight: bold;">
                Nama Jurusan<i style="color: red;">*</i>
              </label>
              <input name="jurusan_nama" type="text" class="form-control" id="inputNamaJurusan" placeholder="Masukkan Nama Jurusan" required="" style="font-weight: bold;">
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
  @foreach($data as $jurusan)
    <div class="modal fade" id="editData{{$jurusan->jurusan_id}}" role="dialog" aria-labelledby="editData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{ route('jurusan.update', $jurusan->jurusan_id) }}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="far fa-edit"></i> &nbsp; Edit Data Jurusan</h5>
            </div>
            <hr>
            <div class="modal-body">
              @csrf 
              @method('PATCH')
              <div class="form-group">
                <label style="font-weight: bold;">Nama Jurusan<i style="color: red;">*</i></label>
                <input type="text" name="jurusan_nama" class="form-control" value="{{ $jurusan->jurusan_nama }}" required="" style="font-weight: bold;">
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
  @foreach($data as $jurusan)
    <div class="modal fade" id="deleteData{{$jurusan->jurusan_id}}" role="dialog" aria-labelledby="deleteData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{route('jurusan.destroy', $jurusan->jurusan_id)}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp; Konfirmasi Hapus</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <hr>
            <div class="modal-body">
              <div class="form-group">
                <h5>
                  <br>
                    Yakin Ingin Menghapus <b>{{$jurusan->jurusan_nama}}</b> ? 
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
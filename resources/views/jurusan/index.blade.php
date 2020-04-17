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
            <button id="btn_add" name="btn_add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</button>
            <!-- <a class="btn btn-primary" href="{{ route('jurusan.create') }}"><i class="fa fa-plus"></i> Add New</button></a> -->
            &nbsp;
            <a class="btn btn-success" href="{{-- route('jurusan.export') --}}"><i class="fa fa-print"></i> Export Data</a>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Jurusan</th>
                  <th scope="col">Jumlah Perusahaan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="jurusans-list" name="jurusans-list">
                 @forelse($data as $jurusan)
                <tr id="jurusan{{$jurusan->jurusan_id}}" >
                  <td width="5%">{{ ++$i }}</td>
                  <td>{{ $jurusan->jurusan_nama }}</td>
                  <td width="20%">{{ $jurusan->perusahaan->count() }}</td>
                  <td width="15%">
                      <div class="btn-group">
                      <a class="btn btn-sm btn-info color open_modal" href="{{ route('jurusan.show', $jurusan->jurusan_id) }}"><i class="fas fa-eye"></i></a>
                      <button class="btn btn-sm btn-warning btn-detail open_modal" value="{{$jurusan->jurusan_id}}"><i class="fas fa-pen"></i></button>
                      <button class="btn btn-sm btn-danger btn-delete delete-jurusan" onclick="return confirm('Delete data?');" value="{{$jurusan->jurusan_id}}"><i class="fas fa-trash"></i></button>
                    <!-- <form action="{{ route('jurusan.destroy', $jurusan->jurusan_id) }}" method="POST">
                      <a class="btn btn-sm btn-warning view_modal color" href="{{ route('jurusan.edit', $jurusan->jurusan_id) }}"><i class="fas fa-pen"></i></a>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete data?');"><i class="fas fa-trash"></i></button>
                    </form> -->
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
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              {!! $data->appends(request()->except('page'))->render() !!}
            </nav>
          </div>
        </div>
      </div>  
  </div>

</section>

 <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ \Request::url() }}">

        <!-- MODAL SECTION -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="frmJurusan" name="frmJurusan" class="form-horizontal" novalidate="">
                  <div class="form-group error">
                    <label for="inputName" class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control has-error" id="jurusan_nama" name="jurusan_nama" placeholder="Nama Jurusan" value="">
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="inputDetail" class="col-sm-3 control-label">Price</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="">
                    </div>
                  </div> -->
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Simpan</button>
                <input type="hidden" id="jurusan_id" name="jurusan_id" value="0">
              </div>
            </div>
          </div>
        </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jurusanAjaxScript.js')}}"></script>
@endsection()
@extends('layouts.adminmain')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>Perusahaan</h1>
  </div>

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
          <a href="{{ route('perusahaan.index') }}" class="pull-right btn btn-outline-info">All Data</a>
        </div>
        <div class="card-header">
          <button id="btn_add" name="btn_add" type="button" data-toggle="modal" data-target="#addData" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Tambah Perusahaan
          </button>
          &nbsp;
          <a class="btn btn-success" href="{{-- route('perusahaan.export') --}}"><i class="fa fa-print"></i> Export Data</a>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Logo</th>
                <th scope="col">Nama Perusahaan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Email</th>
                <th scope="col">Telepon</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
               @forelse($data as $perusahaan)
              <tr>
                <td width="5%">{{ ++$i }}</td>
                <td><img width="120px" src="{{ url('/image/'.$perusahaan->perusahaan_logo) }}"></td>
                <td>{{ $perusahaan->perusahaan_nama }}</td>
                <td>{{ $perusahaan->perusahaan_alamat }}</td>
                <td>{{ $perusahaan->perusahaan_email }}</td>
                <td>{{ $perusahaan->perusahaan_telepon }}</td>

                <td width="15%">
                  <div class="btn-group">
                    <button class="btn btn-sm btn-warning view_modal color" data-toggle="modal" data-target="#editData{{$perusahaan->perusahaan_id}}"><i class="fas fa-pen"></i></button>
                    <a class="btn btn-sm btn-info color open_modal" href="{{ route('perusahaan.show', $perusahaan->perusahaan_id) }}"><i class="fas fa-eye"></i></a>
                    <button class="btn btn-sm btn-danger view_modal color" data-toggle="modal" data-target="#deleteData{{$perusahaan->perusahaan_id}}"><i class="fas fa-trash"></i></button>

                    <!-- <form action="{{route('perusahaan.destroy', $perusahaan->perusahaan_id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger delete color" onclick="return confirm('Are you sure to delete {{ $perusahaan->perusahaan_nama }} ?');"><i class="fas fa-trash"></i></button>
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

<!-- Modal ADD -->
  <div class="modal fade" id="addData" role="dialog" aria-labelledby="addData" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"> 
        <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="DataLabel"><i class="far fa-plus-square"></i>&nbsp; Tambah Data Perusahaan</h5>
          </div>
          <hr>
          <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputNamaJurusan" style="font-weight: bold;">
                Nama Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_nama" type="text" class="form-control" id="inputNamaPerusahaan" placeholder="Masukkan Nama Perusahaan" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Alamat Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_alamat" type="text" class="form-control" id="inputAlamatPerusahaan" placeholder="Masukkan Alamat Perusahaan" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Email Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_email" type="text" class="form-control" id="inputEmailPerusahaan" placeholder="Masukkan Email Perusahaan" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Telepon Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_telepon" type="text" class="form-control" id="inputTeleponPerusahaan" placeholder="Masukkan Telepon Perusahaan" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Logo Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_logo" type="file" class="form-control" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan (1)<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_gambar1" type="file" class="form-control" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan (2)<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_gambar2" type="file" class="form-control" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan (3)<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_gambar3" type="file" class="form-control" required="" style="font-weight: bold;">
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
  @foreach($data as $perusahaan)
    <div class="modal fade" id="editData{{$perusahaan->perusahaan_id}}" role="dialog" aria-labelledby="editData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{ route('perusahaan.update', $perusahaan->perusahaan_id) }}" method="post" enctype="multipart/form-data" >
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="far fa-edit"></i> &nbsp; Edit Data Jurusan</h5>
            </div>
            <hr>
            <div class="modal-body">
              @csrf 
              @method('PATCH')
              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Nama Perusahaan<i style="color: red;">*</i>
                </label>
              </div>
              <input name="perusahaan_nama" type="text" class="form-control" id="inputNamaPerusahaan" value="{{ $perusahaan->perusahaan_nama }}" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Alamat Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_alamat" type="text" class="form-control" id="inputAlamatPerusahaan" value="{{ $perusahaan->perusahaan_alamat }}" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Email Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_email" type="text" class="form-control" id="inputEmailPerusahaan" value="{{ $perusahaan->perusahaan_email }}" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Telepon Perusahaan<i style="color: red;">*</i>
              </label>
              <input name="perusahaan_telepon" type="text" class="form-control" id="inputTeleponPerusahaan" value="{{ $perusahaan->perusahaan_telepon }}" required="" style="font-weight: bold;">

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Logo Perusahaan<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_logo" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_logo) }}">
                <input name="hidden_image1" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_logo}}">
              </div>

              <div class="form-group">
                  <img src="{{ url('image/'.$perusahaan->perusahaan_logo) }}" width="150px">
              </div> 

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan 1<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_gambar1" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_gambar1) }}">
                <input name="hidden_image2" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_gambar1}}">
              </div>

              <div class="form-group">
                  <img src="{{ url('image/'.$perusahaan->perusahaan_gambar1) }}" width="150px">
              </div> 

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan 2<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_gambar2" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_gambar2) }}">
                <input name="hidden_image3" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_gambar2}}">
              </div>

              <div class="form-group">
                  <img src="{{ url('image/'.$perusahaan->perusahaan_gambar2) }}" width="150px">
              </div> 

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan 3<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_gambar3" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_gambar3) }}">
                <input name="hidden_image4" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_gambar1}}">
              </div>

              <div class="form-group">
                  <img src="{{ url('image/'.$perusahaan->perusahaan_gambar3) }}" width="150px">
              </div> 


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
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
 @foreach($data as $perusahaan)
 
     <div class="modal fade" id="deleteData{{$perusahaan->perusahaan_id}}" role="dialog" aria-labelledby="deleteData" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{route('perusahaan.destroy', $perusahaan->perusahaan_id)}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp; Konfirmasi Hapus</h5>
            </div>
            <hr>
            <div class="modal-body">
              <div class="form-group">
                <h5>
                  <br>
                    Hapus <b>{{$perusahaan->perusahaan_nama}}</b> ? 
                </h5>
              </div>
            </div>
            <div class="modal-footer">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  @endforeach

@endsection()
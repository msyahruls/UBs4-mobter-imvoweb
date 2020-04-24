@extends('layouts.adminmain')

@section('content')

<!-- Important to work AJAX CSRF -->
<meta name="_token" content="{!! csrf_token() !!}" />

<section class="section">
  
  <div class="section-header">
    <h1>Ulasan</h1>
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
          <a href="{{ route('ulasan.index') }}" class="pull-right btn btn-outline-info">All Data</a>
        </div>
        <div class="card-header">
          <button id="btn_add" name="btn_add" type="button" data-toggle="modal" data-target="#addData" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Tambah Jurusan
          </button>
          &nbsp;
          <a class="btn btn-success" href="{{-- route('ulasan.export') --}}"><i class="fa fa-print"></i> Export Data</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Mahasiswa</th>
                  <th scope="col">Jurusan</th>
                  <th scope="col">Angkatan Mahasiswa</th>
                  <th scope="col">Perusahaan</th>
                  <th scope="col">Periode</th>
                  <th scope="col">Testimoni</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="ulasan-list" name="ulasan-list">
                @forelse($data as $ulasan)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $ulasan->ulasan_nama_mhs }}</td>
                  <td>{{ $ulasan->Jurusan->jurusan_nama }}</td>
                  <td>{{ $ulasan->ulasan_angkatan }}</td>
                  <td>{{ $ulasan->Perusahaan->perusahaan_nama }}</td>
                  <td>{{ $ulasan->ulasan_periode}}</td>
                  <td>{{ $ulasan->ulasan_testimoni }}</td>
                  <td width="15%">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-warning view_modal color" data-toggle="modal" data-target="#editData{{$ulasan->ulasan_id}}"><i class="fas fa-pen"></i></button>
                      <a class="btn btn-sm btn-info color open_modal" href="{{ route('ulasan.show', $ulasan->ulasan_id) }}"><i class="fas fa-eye"></i></a>
                      <button class="btn btn-sm btn-danger view_modal color" data-toggle="modal" data-target="#deleteData{{$ulasan->ulasan_id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
        <form action="{{ route('ulasan.store') }}" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="DataLabel"><i class="far fa-plus-square"></i>&nbsp; Tambah Data Jurusan</h5>
          </div>
          <hr>
          <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputNamaJurusan" style="font-weight: bold;">
                Nama Mahasiswa<i style="color: red;">*</i>
              </label>
              <input name="ulasan_nama_mhs" type="text" class="form-control" id="inputNamaMahasiswa" placeholder="Masukkan Nama Mahasiswa" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Jurusan Mahasiswa<i style="color: red;">*</i>
              </label>
              <select name="ulasan_jurusan_id" class="form-control" required="">
                @foreach($jurusan as $jrs)
                  <option value="{{$jrs->jurusan_id}}">{{$jrs->jurusan_nama}}</option>
                @endforeach
              </select>

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Angkatan Mahasiswa<i style="color: red;">*</i>
              </label>
              <input name="ulasan_angkatan" type="text" class="form-control" id="inputEmailPerusahaan" placeholder="Masukkan Angkatan Mahasiswa" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Perusahaan Magang<i style="color: red;">*</i>
              </label>
              <select name="ulasan_perusahaan_id" class="form-control" required="">
                @foreach($perusahaan as $jrs)
                  <option value="{{$jrs->perusahaan_id}}">{{$jrs->perusahaan_nama}}</option>
                @endforeach
              </select>

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Periode Magang<i style="color: red;">*</i>
              </label>
              <input name="ulasan_periode" type="text" class="form-control" id="inputEmailPerusahaan" placeholder="Masukkan Periode Magang" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Testimoni<i style="color: red;">*</i>
              </label>
              <input name="ulasan_testimoni" type="text" class="form-control" id="inputEmailPerusahaan" placeholder="Masukkan Testimoni" required="" style="font-weight: bold;">

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
  @foreach($data as $ulasan)
    <div class="modal fade" id="editData{{$ulasan->ulasan_id}}" role="dialog" aria-labelledby="deleteData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{ route('ulasan.update', $ulasan->ulasan_id) }}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="far fa-edit"></i> &nbsp; Edit Data Jurusan</h5>
            </div>
            <hr>
            <div class="modal-body">
              @csrf 
              @method('PATCH')
              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                  Nama Mahasiswa<i style="color: red;">*</i>
                </label>
                <input name="ulasan_nama_mhs" type="text" class="form-control" id="inputNamaPerusahaan" value="{{ $ulasan->ulasan_nama_mhs }}" required="" style="font-weight: bold;">

                <label for="inputNamaJurusan" style="font-weight: bold;">
                Jurusan Mahasiswa<i style="color: red;">*</i>
              </label>
              <select class="form-control" name="ulasan_jurusan_id">
                @foreach( $jurusan as $jrs)
                  <option value="{{ $jrs->jurusan_id }}" {{ $jrs->jurusan_id == $ulasan->ulasan_jurusan_id ? 'selected="selected"' : '' }}> {{ $jrs->jurusan_nama }} </option>
                 @endforeach
              </select>

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Angkatan Mahasiswa<i style="color: red;">*</i>
              </label>
              <input name="ulasan_angkatan" type="text" class="form-control" id="inputEmailPerusahaan" value="{{ $ulasan->ulasan_angkatan }}" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Perusahaan Magang<i style="color: red;">*</i>
              </label>
              <select class="form-control" name="ulasan_perusahaan_id">
                @foreach( $perusahaan as $jrs)
                  <option value="{{ $jrs->perusahaan_id }}" {{ $jrs->perusahaan_id == $ulasan->ulasan_perusahan_id ? 'selected="selected"' : '' }}> {{ $jrs->perusahaan_nama }} </option>
                 @endforeach
              </select> 

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Periode Magang<i style="color: red;">*</i>
              </label>
              <input name="ulasan_periode" type="text" class="form-control" id="inputNamaPerusahaan" value="{{ $ulasan->ulasan_periode }}" required="" style="font-weight: bold;">

              <label for="inputNamaJurusan" style="font-weight: bold;">
                Testimoni<i style="color: red;">*</i>
              </label>
              <input name="ulasan_testimoni" type="text" class="form-control" id="inputNamaPerusahaan" value="{{ $ulasan->ulasan_testimoni }}" required="" style="font-weight: bold;">
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
  @foreach($data as $ulasan)
    <div class="modal fade" id="deleteData{{$ulasan->ulasan_id}}" role="dialog" aria-labelledby="deleteData" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form action="{{route('ulasan.destroy', $ulasan->ulasan_id)}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="DataLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp; Konfirmasi Hapus</h5>
            </div>
            <hr>
            <div class="modal-body">
              <div class="form-group">
                <h5>
                  <br>
                    Hapus <b>{{$ulasan->ulasan_nama_mhs}}</b> ? 
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
<!-- End of Modal DELETE--> 

@endsection()

@extends('layouts.adminmain')

@section('stylesheets')

  {!! Html::style('css/select2.min.css') !!}
  <style type="text/css">
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
    .select2-results { 
      color: #FFF;
      background-color: #003961;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected]{
      color: #FFF;
      background-color: #F39C12;
    }
    .select2-container--default .select2-results__option[aria-selected=true]{
      color: #003961;
      background-color: #F39C12;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      color: #F39C12;
      background-color: #003961; 
    }
  </style>

@endsection

@section('content')

<section class="section">
  
  <div class="section-header">
    <h1>
      Perusahaan <small>Edit Data</small>
    </h1>
  </div>

  

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('perusahaan.index') }}"> 
              <button type="button" class="btn btn-outline-info">
                <i class="fas fa-arrow-circle-left"></i> Back
              </button>
            </a>
            @if (count($errors) > 0)
              <div class="card col-lg-6">
                  <div class="card-body">
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
          @endif
        </div>
        <div class="card-body">
          <form action="{{ route('perusahaan.update', $perusahaan->perusahaan_id) }}" method="post" enctype="multipart/form-data" >
            <hr>
            <div class="modal-body">
              @csrf 
              @method('PATCH')
              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Nama Perusahaan<i style="color: red;">*</i>
                </label>
                <input name="perusahaan_nama" type="text" class="form-control" id="inputNamaPerusahaan" value="{{ $perusahaan->perusahaan_nama }}" required="" style="font-weight: bold;">
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                  Alamat Perusahaan<i style="color: red;">*</i>
                </label>
                <input name="perusahaan_alamat" type="text" class="form-control" id="inputAlamatPerusahaan" value="{{ $perusahaan->perusahaan_alamat }}" required="" style="font-weight: bold;">
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                  Email Perusahaan<i style="color: red;">*</i>
                </label>
                <input name="perusahaan_email" type="text" class="form-control" id="inputEmailPerusahaan" value="{{ $perusahaan->perusahaan_email }}" required="" style="font-weight: bold;">
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                  Telepon Perusahaan<i style="color: red;">*</i>
                </label>
                <input name="perusahaan_telepon" type="text" class="form-control" id="inputTeleponPerusahaan" value="{{ $perusahaan->perusahaan_telepon }}" required="" style="font-weight: bold;">
              </div>

              <div class="form-group">
                <label for="inputJurusan" style="font-weight: bold;">
                  Jurusan<i style="color: red;">*</i>
                </label>
                <select id="selectJurusan{{$perusahaan->perusahaan_id}}" class="form-control select2-multi-edit" name="jurusan[]" multiple="multiple">
                  @foreach($data as $jurusan)
                    <option value="{{$jurusan->jurusan_id}}" class="form-control">{{$jurusan->jurusan_nama}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Logo Perusahaan<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_logo" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_logo) }}">
                <input name="hidden_image1" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_logo}}">
                <img src="{{ url('image/'.$perusahaan->perusahaan_logo) }}" width="150px">
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan 1<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_gambar1" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_gambar1) }}">
                <input name="hidden_image2" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_gambar1}}">
                  <img src="{{ url('image/'.$perusahaan->perusahaan_gambar1) }}" width="150px">
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan 2<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_gambar2" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_gambar2) }}">
                <input name="hidden_image3" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_gambar2}}">
                  <img src="{{ url('image/'.$perusahaan->perusahaan_gambar2) }}" width="150px">
              </div>

              <div class="form-group">
                <label for="inputNamaJurusan" style="font-weight: bold;">
                Gambar Perusahaan 3<i style="color: red;">*</i>
                 </label>
                <input name="perusahaan_gambar3" type="file" class="form-control" value="{{ url('/image/'.$perusahaan->perusahaan_gambar3) }}">
                <input name="hidden_image4" type="hidden" class="form-control" value="{{$perusahaan->perusahaan_gambar1}}">
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
        <div class="card-footer text-right">
          
        </div>
      </div>
    </div>  
  </div>
</section>

@endsection

@section('scripts')

  {!! Html::script('js/select2.min.js') !!}

  <script type="text/javascript">
    $(document).ready(function() {
      $('.select2-multi-edit').select2();
      $('.select2-multi-edit').select2().val({{ json_encode($perusahaan->jurusan()->allRelatedIds()) }}).trigger('change');
    });
  </script>

@endsection
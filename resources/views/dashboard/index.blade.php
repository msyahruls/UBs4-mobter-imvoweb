@extends('layouts.adminmain')

@section('content')

<!-- Important to work AJAX CSRF -->
<meta name="_token" content="{!! csrf_token() !!}" />

<section class="section">
  
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-building"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Berita</h4>
            </div>
            <div class="card-body">
              {{$brt}} Item
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-building"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Jurusan</h4>
            </div>
            <div class="card-body">
              {{$jrsn}} Item
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="far fa-building"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Perusahaan</h4>
            </div>
            <div class="card-body">
              {{$prshn}} Item
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-building"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Ulasan</h4>
            </div>
            <div class="card-body">
              {{$ulsn}} Item
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <form method="GET" class="form-inline">
            <div class="form-group">
              <input type="text" name="search" class="form-control" placeholder="Cari Jurusan & Perusahaan Magang" value="{{ request()->get('search') }}" style="width: 500px;">
            </div>
            &nbsp;
            <div class="form-group">
              <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
            </div>
            &nbsp;
            <a href="{{ route('dashboard.index') }}" class="pull-right btn btn-outline-primary">Refresh</a>
          </form>
        </div>
        <div class="card-header">
          <h5>Jurusan Magang Yang Tersedia</h5>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach($data as $perusahaan)
            <div class="col-md-6">
              <div class="card mb-3" style="max-width: 540px; background-color: #f2f2f2; max-height: 200px;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="{{ url('/images/perusahaan/'.$perusahaan->perusahaan_logo) }}" width="150" max-height="180">
                    <center>
                        <span style="margin-top: 15px;">{{$perusahaan->perusahaan_email}}</span>
                    </center>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">
                        {{$perusahaan->perusahaan_nama}} 
                      </h5>
                      <br>
                      <div style="margin-top: -38px;">
                       {{$perusahaan->perusahaan_alamat}}
                      </div>
                      <br>
                      <style type="text/css">
                        div.scrolllabe{
                          background-color: none; 
                          width: 280px; 
                          height: 120px;  
                          overflow-x: auto;
                          margin-top: -10px;
                        }
                      </style>
                      <div class="scrolllabe">
                        @foreach($perusahaan->jurusan as $jrsn)
                          <span style="background-color: #003961; margin-top: 5px;" class="badge badge-info">
                            {{ $jrsn->jurusan_nama}}
                          </span>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          {!! $data->links() !!}
        </div>
        <div class="card-footer text-right">
          <nav class="d-inline-block">
            
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection()

$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    //display modal form for creating new jurusan *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmJurusan').trigger("reset");
        $('#myModal').modal('show');
    });

    //display modal form for jurusan EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var jurusan_id = $(this).val();
        console.log(url);
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + jurusan_id,
            success: function (data) {
                console.log(data);
                $('#jurusan_id').val(data.jurusan_id);
                $('#jurusan_nama').val(data.jurusan_nama);
                // $('#price').val(data.price);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new jurusan / update existing jurusan ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            name: $('#jurusan_nama').val(),
            // price: $('#price').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var jurusan_id = $('#jurusan_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + jurusan_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var jurusan = '<tr id="jurusan' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.price + '</td>';
                jurusan += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
                jurusan += ' <button class="btn btn-danger btn-delete delete-jurusan" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#jurusans-list').append(jurusan);
                }else{ //if user updated an existing record
                    $("#jurusan" + jurusan_id).replaceWith( jurusan );
                }
                $('#frmJurusan').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //delete jurusan and remove it from TABLE list ***************************
    $(document).on('click','.delete-jurusan',function(){
        var jurusan_id = $(this).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + jurusan_id,
            success: function (data) {
                console.log(data);
                $("#jurusan" + jurusan_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});

//Nitip Codingan Modal edit nang kene kan soale ga kegawe nang perusahaan ^_^
<!-- Modal Edit -->
  {{-- @foreach($data as $perusahaan)
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

              <label for="inputJurusan" style="font-weight: bold;">
                Jurusan<i style="color: red;">*</i>
              </label>
              <select id="selectJurusan{{$perusahaan->perusahaan_id}}" class="form-control select2-multi-edit" name="jurusan[]" multiple="multiple">
                @foreach($perusahaan->jurusan as $jurusanSelected)
                    <option value="{{ $jurusanAll->jurusan_id }}" {{ $jurusanAll->jurusan_id == $jurusanSelected->jurusan_id ? 'selected="selected"' : '' }} >{{ $jurusanAll->jurusan_nama }}</option>
                    <option selected="" value="{{$jurusanSelected->jurusan_id}}" class="form-control">{{$jurusanSelected->jurusan_nama}}</option>
                  @endforeach
                @foreach($jurusanData as $jurusan)
                  @foreach($perusahaan->jurusan as $jurusanSelected)
                    <option value="{{$jurusan->jurusan_id}}" class="form-control">{{$jurusan->jurusan_nama}}</option>
                    <option value="{{ $jurusanAll->jurusan_id }}" {{ $jurusanAll->jurusan_id == $jurusanSelected->jurusan_id ? 'selected="selected"' : '' }} >{{ $jurusanAll->jurusan_nama }}</option>
                  @endforeach
                  <option value="{{$jurusan->jurusan_id}}" class="form-control">{{$jurusan->jurusan_nama}}</option>
                @endforeach
              </select>

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

  @endforeach --}}
<!-- End of Modal Edit-->
$(document).ready(function(){
    //get base URL *********************
    var url = "jurusan/";

    //display modal form for creating new jurusan *********************
    $('#btn_add').click(function(){
        $('#myModalLabel').text('Tambah Jurusan');
        $('#btn-save').val("add");
        $('#frmJurusan').trigger("reset");
        $('#myModal').modal('show');
    });

    //display modal form for jurusan EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var jurusan_id = $(this).val();
        $.ajax({
            type: "GET",
            url: url+jurusan_id,
            success: function (data) {
                console.log(data);
                $('#myModalLabel').text('Ubah Jurusan');
                $('#jurusan_id').val(data.jurusan_id);
                $('#jurusan_nama').val(data.jurusan_nama);
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
          jurusan_id: $('#jurusan_id').val(),
          jurusan_nama: $('#jurusan_nama').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var jurusan_id = $('#jurusan_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += jurusan_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                location.reload();

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
            url: url + jurusan_id,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});
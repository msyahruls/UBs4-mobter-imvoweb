
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
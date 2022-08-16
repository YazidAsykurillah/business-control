@extends('adminlte::page')

@section('title', 'Create Customer')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create Customer</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="/home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/customer">
                        Customers
                    </a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="card">
        <form class="" id="form-create" action="{{ url('/customer')}}" method="POST">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Create Customer Form</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Name of the customer">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tax_number" class="col-sm-2 col-form-label">Tax Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tax_number" placeholder="Tax Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_id" class="col-sm-2 col-form-label">User</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="user_id" id="user_id"></select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/customer" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Save</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){


    //Block select user id
    $('#user_id').select2({
        placeholder: 'Select User',
        ajax: {
            url: "{!! url('/user/select2') !!}",
            dataType: 'json',
            delay: 250,
            processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                results:  $.map(data.data, function (item) {
                    return{
                        text: item.name,
                        id: item.id,
                        code: item.code,
                    }
                }),
                pagination: {
                  more: (params.page * data.per_page) < data.total
                },
              };
            },
            cache: true
        },
        allowClear : true,
        templateResult : templateResultUser,
    });

    function templateResultUser(results){
      if(results.loading){
        return "Searching...";
      }
      var markup = '<span>';
          markup+=  results.code;
          markup+=  '<br/>';
          markup+=  results.text;
          markup+= '</span>';
      return $(markup);
    }
    //ENDBlock select user id

    //Block store  event
    $('#form-create').on('submit', function(event){
        event.preventDefault();
        let url = $(this).attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend:function(){
                $('#form-create').find("button[type='submit']").prop('disabled', true);
            },
            success: function(data){
                console.log(data);
                if(data.status == true){
                    $('#form-create')[0].reset();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: data.message
                    });
                    $('#form-create').find("button[type='submit']").prop('disabled', false);
                    window.location.href = data.data.url;
                }else{
                    $('#form-create').find("button[type='submit']").prop('disabled', false);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                let errors = jqXHR.responseJSON;
                console.log(errors);
                let error_template = "";
                //console.log(textStatus);
                $.each( errors.errors, function( key, value ){
                    console.log(value);
                    error_template += '<p>'+value+ '</p>'; //showing only the first error.
                });
                console.log(error_template);
                $(document).Toasts('create',{
                    class: 'bg-danger',
                    position: 'bottomRight',
                    autohide: true,
                    delay: 5000,
                    icon: 'fas fa-exclamation-circle',
                    title: 'Error',
                    subtitle: ' Validation error',
                    body: error_template
                });
                $('#form-create').find("button[type='submit']").prop('disabled', false);
            }
        });
    });
    //ENDBlock store  event
});
</script>
@stop

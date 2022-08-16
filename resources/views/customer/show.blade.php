@extends('adminlte::page')

@section('title', 'Customer Detail:: '.$customer->name)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Customer Detail</h1>
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
                        Customer
                    </a>
                </li>
                <li class="breadcrumb-item active">{{$customer->name}}</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">General Information</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>{{$customer->name}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td>{{$customer->address}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contacts List</h3>
                    <div class="card-tools">
                        <button type="button" id="btn-create-customer-contact" class="btn btn-default btn-xs" title="Add Contact">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table-contacts">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>


    <!--Modal Create Customer Contact-->
    <div class="modal fade" data-backdrop="static" id="modal-create-customer-contact">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form class="form-horizontal" id="form-create-customer-contact" action="{{ url('/customer-contact')}}" method="POST">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create Customer Contact</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-6">
                            <input type="text" name="phone_number" id="phone_number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-6">
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="text" name="customer_id" value="{{$customer->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <!--ENDModal Create Customer Contact-->
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    const customer_id ='{{$customer->id}}';

    var customerContactDT = $('#table-contacts').DataTable({
        processing: true,
        serverSide: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        ajax: '/customer/'+customer_id+'/contact-datatables',
        columns: [
            {
                data: 'name',
                name: 'name',
                render:function(data,type,row,meta){
                    let name_temp='';
                        name_temp+='<a href="/customer/'+row.id+'">';
                        name_temp+= data;
                        name_temp+='</a>';
                    return name_temp;
                }
            },
            {data: 'phone_number', name: 'phone_number'},
            {data: 'email', name: 'email'},
            {data: 'description', name: 'description'},
        ],
        order: [
            [ 0, "asc" ],
        ],
    });

    //Block Create Customer Contact
    $('#btn-create-customer-contact').on('click', function(event){
        event.preventDefault();
        $('#modal-create-customer-contact').modal('show');
    });

    $('#form-create-customer-contact').on('submit', function(event){
        event.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#form-create-customer-contact').find("button[type='submit']").prop('disabled', true);
            },
            success: function(data){
                console.log(data);
                if(data.status == true){
                    $('#form-create-customer-contact')[0].reset();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: data.message
                    });
                    $('#form-create-customer-contact').find("button[type='submit']").prop('disabled', false);
                    customerContactDT.ajax.reload();
                    $('#modal-create-customer-contact').modal('hide');
                }else{
                    $('#form-create-customer-contact').find("button[type='submit']").prop('disabled', false);
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
                $('#form-create-customer-contact').find("button[type='submit']").prop('disabled', false);
            }
       });
    });
    //ENDBlock Create Customer Contact

});
</script>
@stop

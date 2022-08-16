@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Roles</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="/home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles List</h3>
            <div class="card-tools">
                <button type="button" id="btn-create" class="btn btn-default btn-sm" title="Create new role">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button type="button" id="btn-delete" class="btn btn-default btn-sm" title="Delete selected roles">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="table-role" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;text-align: center;">#</th>
                        <th style="width: 20%;">Code</th>
                        <th>Name</th>
                        <th style="width:10%; text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="card-footer">
            <div id="data-table-button-tools" class=""></div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    var roleDT = $('#table-role').DataTable({
        processing: true,
        serverSide: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        ajax: "{{ url('role/datatables') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
            {data: 'code', name: 'code', render:function(data, type, row, meta){
                let code_template='';
                    code_template+='<a href="/role/'+row.id+'">';
                    code_template+= data;
                    code_template+='</a>';
                return code_template;
            }},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                let action ='';
                    action+='<button class="btn btn-default btn-xs btn-edit" title="Edit">';
                    action+=    '<i class="fas fa-edit"></i>';
                    action+='</button>';
                return action;
            }},
        ],
        order: [
            [ 1, "asc" ],
        ],
    });

    //Block data table button tools object
    var dataTableButtonTools = new $.fn.dataTable.Buttons(roleDT,{
        buttons: [
            {
                extend: 'excelHtml5',
                text:'Export Excel',
                className: 'fa fa-file-excel',
                exportOptions:{
                    columns:[1,2],
                    format:{
                        body: function(data, row, column, node){
                            data = $('<p>' + data + '</p>').text();
                            return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
                        }
                    }
                },
                
            },
        ],
    }).container().appendTo($('#data-table-button-tools'));
    //ENDBlock data table button tools object
});
</script>
@stop

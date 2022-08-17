@extends('adminlte::page')

@section('title', 'Quotation Customers')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Quotation Customers</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="/home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Quotation Customers</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Quotation Customers List
            </h3>
            <div class="card-tools">
                <a href="/quotation-customer/create" class="btn btn-default btn-sm">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <button type="button" id="btn-delete" class="btn btn-default btn-sm" title="Delete selected Quotation Customers">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="table-quotation-customer" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;text-align: center;">#</th>
                        <th style="width: 10%;">Code</th>
                        <th>Customer</th>
                        <th style="width:10%;">Date</th>
                        <th style="width:10%;">Valid Until</th>
                        <th style="width:10%;">Preparator</th>
                        <th style="width:15%;">Total Quotes</th>
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

    var quotationCustomerDT = $('#table-quotation-customer').DataTable({
        processing: true,
        serverSide: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        ajax: "{{ url('quotation-customer/datatables') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
            {data: 'code', name: 'code', render:function(data, type, row, meta){
                let code_template='';
                    code_template+='<a href="/quotation-customer/'+row.id+'">';
                    code_template+= data;
                    code_template+='</a>';
                return code_template;
            }},
            {
                data: 'customer.name',
                name: 'customer.name',
            },
            {data: 'date', name: 'date'},
            {data: 'validation_date', name: 'validation_date'},
            {
                data: 'preparator.name',
                name: 'preparator.name',
            },
            {
                data: 'total_quotes',
                name: 'total_quotes',
                render:function(data,type,row,meta){
                    return accounting.formatNumber(data,{
                            precision: 2,
                            thousand: ",",
                            decimal : "."
                        });
                }
            },
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

});
</script>
@stop

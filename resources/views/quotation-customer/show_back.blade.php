@extends('adminlte::page')

@section('title', ''.$quotation_customer->code.'')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Quotation Customer Detail</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="/home">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/quotation-customer">
                        Quotation Customers
                    </a>
                </li>
                <li class="breadcrumb-item active">{{$quotation_customer->code}}</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{$quotation_customer->code}}
                </h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="width:20%;">Code</td>
                                <td style="width:5%;">:</td>
                                <td>{{$quotation_customer->code}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Customer</td>
                                <td style="width:5%;">:</td>
                                <td>{{$quotation_customer->customer->name}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Date</td>
                                <td style="width:5%;">:</td>
                                <td>{{$quotation_customer->date}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Valid Until</td>
                                <td style="width:5%;">:</td>
                                <td>{{$quotation_customer->validation_date}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Description of work</td>
                                <td style="width:5%;">:</td>
                                <td>{{$quotation_customer->description_of_work}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Itemized Costs
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-items" class="table">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th>Name</th>
                                <th style="width:10%;">Qty</th>
                                <th style="width:10%;">Unit</th>
                                <th style="width:20%;">Unit Price</th>
                                <th style="width:20%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    const QC_ID='{{$quotation_customer->id}}';
    //Datatable Quotation Customer Items
    var itemsDT = $('#table-items').DataTable({
        processing: true,
        serverSide: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        ajax: '/quotation-customer/'+QC_ID+'/items-datatables',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
            {data: 'name', name: 'name'},
            {
                data: 'quantity',
                name: 'quantity',
                render:function(data,type,row,meta){
                    return accounting.formatNumber(data,{
                            precision: 2,
                            thousand: ",",
                            decimal : "."
                        });
                }
            },
            {data: 'unit', name: 'unit'},
            {
                data: 'unit_price',
                name: 'unit_price',
                render:function(data,type,row,meta){
                    return accounting.formatNumber(data,{
                            precision: 2,
                            thousand: ",",
                            decimal : "."
                        });
                }
            },
            {
                data: 'amount',
                name: 'amount',
                render:function(data,type,row,meta){
                    return accounting.formatNumber(data,{
                            precision: 2,
                            thousand: ",",
                            decimal : "."
                        });
                }
            },
        ],
        order: [
            [ 1, "asc" ],
        ],
    });


});
</script>
@stop

@extends('adminlte::page')

@section('title', ''.$quotation_customer->code.'')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Quotation Customer</h1>
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
                    General Information
                </h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Code</td>
                                <td>:</td>
                                <td>{{$quotation_customer->code}}</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>:</td>
                                <td>{{$quotation_customer->customer->name}}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td>{{$quotation_customer->date}}</td>
                            </tr>
                            <tr>
                                <td>Valid Until</td>
                                <td>:</td>
                                <td>{{$quotation_customer->validation_date}}</td>
                            </tr>
                            <tr>
                                <td>Description of work</td>
                                <td>:</td>
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
                                <th>Name</th>
                                <th style="width:10%;">Qty</th>
                                <th style="width:10%;">Unit</th>
                                <th style="width:20%;">Unit Price</th>
                                <th style="width:20%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($quotation_customer->quotation_customer_items)
                            @foreach($quotation_customer->quotation_customer_items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->unit}}</td>
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item->amount}}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total Amount</strong></td>
                                <td>
                                    <input type="text" name="total_amount" id="total_amount" class="form-control" value="" readonly>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Discount Amount</strong></td>
                                <td>
                                    <input type="text" name="discount_amount" id="discount_amount" class="form-control" value="{{$quotation_customer->discount_amount}}" readonly>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total Quotes</strong></td>
                                <td>
                                    <input type="text" name="total_quotes" id="total_quotes" class="form-control" value="{{$quotation_customer->total_quotes}}" readonly>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
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


});
</script>
@stop

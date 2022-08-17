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
            <!--Card Body General Information-->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-quotation-customer" class="table">
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
            <!--ENDCard Body General Information-->

            <!--Card Body Items-->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-items" class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th style="width:10%;">Qty</th>
                                <th style="width:10%;">Unit</th>
                                <th style="width:20%;">Unit Price</th>
                                <th style="width:20%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align:right;font-style: italic;">Total Amount</td>
                                <td>{{number_format($total_amount,2)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!--ENDCard Body Items-->

            <!--Card Body Discount and Price Information-->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-quotation-customer" class="table">
                        <tbody>
                            <tr>
                                <td style="width:20%;">Discount Amount</td>
                                <td style="width:5%;">:</td>
                                <td>{{number_format($quotation_customer->discount_amount,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Total Quotes</td>
                                <td style="width:5%;">:</td>
                                <td>{{number_format($quotation_customer->total_quotes,2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--ENDCard Body Discount and Price Information-->

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

    //Quotation Customer Items
    let quotation_customer_items_api_url = '/api/quotation-customer/'+QC_ID+'/get-items';
    $.get(quotation_customer_items_api_url, function (data, status){
        let items_count = data.data.length;

        let row_items_temp='';
        if(data.status == true && items_count>0){
            $.each(data.data, function (key, value){
                let formated_quantity = accounting.formatNumber(value.quantity,{
                                            precision: 2,
                                            thousand: ",",
                                            decimal : "."
                                        });
                let formated_unit_price = accounting.formatNumber(value.unit_price,{
                                            precision: 2,
                                            thousand: ",",
                                            decimal : "."
                                        });
                let formated_amount = accounting.formatNumber(value.amount,{
                                            precision: 2,
                                            thousand: ",",
                                            decimal : "."
                                        });
                row_items_temp+='<tr>';
                row_items_temp+=    '<td>';
                row_items_temp+=        value.name;
                row_items_temp+=    '</td>';
                row_items_temp+=    '<td>';
                row_items_temp+=        formated_quantity;
                row_items_temp+=    '</td>';
                row_items_temp+=    '<td>';
                row_items_temp+=        value.unit;
                row_items_temp+=    '</td>';
                row_items_temp+=    '<td>';
                row_items_temp+=        formated_unit_price;
                row_items_temp+=    '</td>';
                row_items_temp+=    '<td>';
                row_items_temp+=        formated_amount;
                row_items_temp+=    '</td>';
                row_items_temp+='</tr>';
            });
            $('#table-items').find('tbody').append(row_items_temp);
        }

    });
    
});
</script>
@stop

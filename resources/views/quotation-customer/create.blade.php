@extends('adminlte::page')

@section('title', 'Create Quotation Customer')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create Quotation Customer</h1>
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
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<form class="" id="form-create-quotation-customer" action="{{ url('/quotation-customer')}}" method="POST">
@csrf
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    General Information
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="customer_id" id="customer_id"></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-3">
                        <input type="text" name="date" class="form-control" id="date" placeholder="Date of the Quotation">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="validation_date" class="col-sm-2 col-form-label">Valid Until</label>
                    <div class="col-sm-3">
                        <input type="text" name="validation_date" class="form-control" id="validation_date" placeholder="Date validation">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description_of_work" class="col-sm-2 col-form-label">Description Of Work</label>
                    <div class="col-sm-6">
                        <textarea name="description_of_work" id="description_of_work" class="form-control"></textarea>
                    </div>
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
                                <th style="width:5%">
                                    <button id="btn-add-item" class="btn btn-primary btn-xs" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="item_name[]" class="form-control item_name" value="" required />
                                </td>
                                <td>
                                    <input type="text" name="quantity[]" class="form-control quantity" value="" required />
                                </td>
                                <td>
                                    <input type="text" name="unit[]" class="form-control unit" value="" required />
                                </td>
                                <td>
                                    <input type="text" name="unit_price[]" class="form-control unit_price" value="" required />
                                </td>
                                <td>
                                    <input type="text" name="amount[]" class="form-control amount" value="" readonly required />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-delete-item">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
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
                                    <input type="text" name="discount_amount" id="discount_amount" class="form-control" value="">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total Quotes</strong></td>
                                <td>
                                    <input type="text" name="total_quotes" id="total_quotes" class="form-control" value="" readonly>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="/quotation-customer" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>
</form>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){

    //Block select customer id
    $('#customer_id').select2({
        placeholder: 'Select Customer',
        ajax: {
            url: "{!! url('/customer/select2') !!}",
            dataType: 'json',
            delay: 250,
            processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                results:  $.map(data.data, function (item) {
                    return{
                        text: item.name,
                        id: item.id,
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
        templateResult : templateResulCustomer,
    });

    function templateResulCustomer(results){
      if(results.loading){
        return "Searching...";
      }
      var markup = '<span>';
          markup+=  results.text;
          markup+= '</span>';
      return $(markup);
    }
    //ENDBlock select customer id

    //Block Date
    $('#date').daterangepicker({
        singleDatePicker: true,
        showDropdowns:true,
        locale: {
          format: 'YYYY-MM-DD'
        },
    }).on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    //ENDBlock Date

    //Block Validation Date 
    $('#validation_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns:true,
        locale: {
          format: 'YYYY-MM-DD'
        },
    }).on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    //ENDBlock Validation Date

    buildAutonumericalInputs();
    function buildAutonumericalInputs(){
        //Quantity
        new AutoNumeric.multiple('.quantity',{
            digitGroupSeparator:',',
            decimalCharacter:'.',
            decimalPlaces:'2',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });

        //Unit Price
        new AutoNumeric.multiple('.unit_price',{
            digitGroupSeparator:',',
            decimalCharacter:'.',
            decimalPlaces:'2',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });

        //Discount Amount
        new AutoNumeric('#discount_amount',{
            digitGroupSeparator:',',
            decimalCharacter:'.',
            decimalPlaces:'2',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });


        
    }

    //Block Add Item
    $('#btn-add-item').on('click', function(event){
        event.preventDefault();
        let uuid = generateUUID();
        let row_item ='';
            row_item+='<tr>';
            row_item+=  '<td>';
            row_item+=      '<input type="text" name="item_name[]" class="form-control item_name" value="" required />';
            row_item+=  '</td>';
            row_item+=  '<td>';
            row_item+=      '<input type="text" name="quantity[]" id="quantity_'+uuid+'" class="form-control quantity" value="" required />';
            row_item+=  '</td>';
            row_item+=  '<td>';
            row_item+=      '<input type="text" name="unit[]" class="form-control unit" value="" required />';
            row_item+=  '</td>';
            row_item+=  '<td>';
            row_item+=      '<input type="text" name="unit_price[]" id="unit_price_'+uuid+'" class="form-control unit_price" value="" required />';
            row_item+=  '</td>';
            row_item+=  '<td>';
            row_item+=      '<input type="text" name="amount[]" class="form-control amount" value="" readonly required />';
            row_item+=  '</td>';
            row_item+=  '<td>';
            row_item+=      '<button type="button" class="btn btn-danger btn-xs btn-delete-item">';
            row_item+=          '<i class="fa fa-trash"></i>';
            row_item+=      '</button>';
            row_item+=  '</td>';
            row_item+='</tr>';
        $('#table-items').find('tbody').append(row_item);
        $('#table-items').find('tr td button.btn-delete-item').on('click', function(){
            remove_row_item($(this));
        });
        applyAutonumericToQuantityInputs('#quantity_'+uuid);
        applyAutonumericToUnitPriceInputs('#unit_price_'+uuid);
        registerKeyUpEventOnQuantityInputs();
        registerKeyUpEventOnUnitPriceInputs();

    });
    //ENDBlock Add Item

    function applyAutonumericToQuantityInputs(selector){
        new AutoNumeric(selector,{
            digitGroupSeparator:',',
            decimalCharacter:'.',
            decimalPlaces:'2',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });
    }

    function applyAutonumericToUnitPriceInputs(selector){
        new AutoNumeric(selector,{
            digitGroupSeparator:',',
            decimalCharacter:'.',
            decimalPlaces:'2',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });
    }

    registerKeyUpEventOnQuantityInputs();
    function registerKeyUpEventOnQuantityInputs(){
        $('.quantity').keyup(function(){
            setAmountValue($(this));
        });    
    }
    
    registerKeyUpEventOnUnitPriceInputs();
    function registerKeyUpEventOnUnitPriceInputs(){
        $('.unit_price').keyup(function(){
            setAmountValue($(this));
        });
    }

    registerKeyUpEventOnDiscountValueInput();
    function registerKeyUpEventOnDiscountValueInput(){
        $('#discount_amount').keyup(function(){
            setTotalQuotes();
        });
    }
    

    function setAmountValue(obj){
        console.log('setAmountValue is called');
        let quantity_value = getFloatValue(obj.parent().parent().find('.quantity').val());
        let unit_price = getFloatValue(obj.parent().parent().find('.unit_price').val());
        let amount_value = quantity_value*unit_price;
        let formated_amount_value = accounting.formatNumber(amount_value,{
                                precision: 2,
                                thousand: ",",
                                decimal : "."
                            });
        obj.parent().parent().find('.amount').val(formated_amount_value);
        set_total_amount();
        setTotalQuotes();
    }

    //Block function to remove row item
    $('.btn-delete-item').on('click', function(){
        remove_row_item($(this));
    });
    function remove_row_item(obj){
        $(obj).parent().parent().remove();
        set_total_amount();
    }
    //ENDBlock function to remove row item

    //Block set total amount input
    function set_total_amount(){
      let sum = 0;
      $('.amount').each(function(){
          sum += +$(this).val().replace(/,/g, '');
      });
      let formatted_sum = accounting.formatNumber(sum,{
                                precision: 2,
                                thousand: ",",
                                decimal : "."
                            });
      $('#total_amount').val(formatted_sum);
      setTotalQuotes();
    }
    //ENDBlock set total amount input

    //Block get total amount
    function getTotalAmount(){
        return getFloatValue($('#total_amount').val());
    }
    //ENDBlock get total amount

    //Block get discount amount
    function getDiscountAmount(){
        return getFloatValue($('#discount_amount').val());
    }
    //ENDBlock get discount amount

    //Block get float value
    function getFloatValue(i){
        if(i==''){
            return 0;
        }else{
            return typeof i === 'string'?parseFloat(i.replace(/[\$,]/g, '')) :typeof i === 'number' ?i : 0;    
        }
    }
    //ENDBlock get float value

    function setTotalQuotes()
    {
        console.log('setTotalQuotes:');
        let total_amount = getTotalAmount();
        let discount_amount = getDiscountAmount();
        let total_quotes = total_amount-discount_amount;
        let formated_total_quotes = accounting.formatNumber(total_quotes,{
                                precision: 2,
                                thousand: ",",
                                decimal : "."
                            });
        $('#total_quotes').val(formated_total_quotes);
    }

    //Block generate UUID
    function generateUUID() {
        let d = new Date().getTime();
        let uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            let r = (d + Math.random()*16)%16 | 0;
            d = Math.floor(d/16);
            return (c=='x' ? r : (r&0x3|0x8)).toString(16);
        });
        return uuid;
    };
    //ENDBlock generate UUID


    //Block Form Quotation Customer Request Submit
    $('#form-create-quotation-customer').on('submit', function(event){
        event.preventDefault();
        let url = $(this).attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend:function(){
                $('#form-create-quotation-customer').find("button[type='submit']").prop('disabled', true);
            },
            success: function(data){
                console.log(data);
                if(data.status == true){
                    $('#form-create-quotation-customer')[0].reset();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: data.message
                    });
                    $('#form-create-quotation-customer').find("button[type='submit']").prop('disabled', false);
                    window.location.href = data.data.url;
                }else{
                    $('#form-create-quotation-customer').find("button[type='submit']").prop('disabled', false);
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
                $('#form-create-quotation-customer').find("button[type='submit']").prop('disabled', false);
            }
        });
    });
    //ENDBlock Form Quotation Customer Request Submit

});
</script>
@stop

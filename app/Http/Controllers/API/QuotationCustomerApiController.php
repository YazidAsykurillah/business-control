<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\QuotationCustomer;
use App\QuotationCustomerItem;

class QuotationCustomerApiController extends Controller
{
    public function getItems($quotation_customer_id)
    {
        $response=[];
        try {
            $quotation_customer = QuotationCustomer::findOrFail($quotation_customer_id);
            $response['status'] = TRUE;
            $response['data']=$quotation_customer->quotation_customer_items;
        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }
}

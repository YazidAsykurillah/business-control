<?php

namespace App\Library\Services;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\QuotationCustomer;
use App\QuotationCustomerItem;

class QuotationCustomerService{

	public static function registerQuotationCustomerItems($quotation_customer_id=NULL,$data=[]){

		if($quotation_customer_id && count($data)){
			foreach($data as $dt){
				$quotation_customer_item = new QuotationCustomerItem;
				$quotation_customer_item->quotation_customer_id = $quotation_customer_id;
				$quotation_customer_item->name=$dt['name'];
				$quotation_customer_item->quantity=$dt['quantity'];
				$quotation_customer_item->unit=$dt['unit'];
				$quotation_customer_item->unit_price=$dt['unit_price'];
				$quotation_customer_item->amount=$dt['amount'];
				$quotation_customer_item->save();
			}
		}
	}
}